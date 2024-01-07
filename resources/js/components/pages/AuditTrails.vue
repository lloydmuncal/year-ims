<template>
    <div class="container mx-auto p-4">
        <div class="flex  justify-between">
            <div >
                <select id="Title" v-model="Title" @change="loadData" class="border-2 font-bold  bg-gray-300  p-2 rounded-xl">
                    <!-- <option value="" disabled selected >Select Section</option> -->
                    <option value="Login">Login</option>
                    <option value="Download">Download</option>
                    <option value="Archive">Archive</option>
                </select>
            </div>
            <div class="mt-2">
                <button @click="exportExcel()" class="flex border-2 px-3 rounded-xl py-1 text-white bg-gray-600 text-lg font-bold" title="Extract Excel File">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path d="M2.85858 2.87756L15.4293 1.08175C15.7027 1.0427 15.9559 1.23265 15.995 1.50601C15.9983 1.52943 16 1.55306 16 1.57672V22.4237C16 22.6999 15.7761 22.9237 15.5 22.9237C15.4763 22.9237 15.4527 22.922 15.4293 22.9187L2.85858 21.1229C2.36593 21.0525 2 20.6306 2 20.1329V3.86751C2 3.36986 2.36593 2.94794 2.85858 2.87756ZM4 4.73481V19.2656L14 20.6942V3.30624L4 4.73481ZM17 19.0002H20V5.00022H17V3.00022H21C21.5523 3.00022 22 3.44793 22 4.00022V20.0002C22 20.5525 21.5523 21.0002 21 21.0002H17V19.0002ZM10.2 12.0002L13 16.0002H10.6L9 13.7145L7.39999 16.0002H5L7.8 12.0002L5 8.00022H7.39999L9 10.2859L10.6 8.00022H13L10.2 12.0002Z" fill="rgba(255,255,255,1)"></path>
                    </svg>
                    Extract .xls
                </button>
             </div>
        </div>
      <div class="overflow-x-auto  shadow-xl">
        <div class="max-h-96 overflow-y-auto border-4"> <!-- Set max height as needed -->
          <table class="min-w-full bg-white border-4-gray-200 "  >
            <thead>
              <tr class="text-white">
                <th class="sticky top-0 bg-gray-700 p-2 border-b  md:table-cell">Date & Time</th>
                <th class="sticky top-0 bg-gray-700 p-2 border-b  md:table-cell">First Name</th>
                <th class="sticky top-0 bg-gray-700 p-2 border-b  md:table-cell">Sur Name</th>
                <th class="sticky top-0 bg-gray-700 p-2 border-b  md:table-cell">LRN No.</th>
                <th class="sticky top-0 bg-gray-700 p-2 border-b  md:table-cell">Details</th>
              </tr>
            </thead>
            <tbody  class="text-center">
              <tr v-for="(log, index) in auditLogs" :key="index">
                <td class="p-2 border-b  md:table-cell">{{ log.Date }}</td>
                <td class="p-2 border-b  md:table-cell">{{ log.FirstName }}</td>
                <td class="p-2 border-b  md:table-cell">{{ log.LastName }}</td>
                <td class="p-2 border-b  md:table-cell">{{ log.LRN }}</td>
                <td class="p-2 border-b  md:table-cell w-[140px]">
                    <div class="bg-green-500 rounded-xl text-white p-1 "> {{ log.Details }}</div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </template>

  <script>
  export default {
    data() {
      return {
        auditLogs: [],
        Title:'Login'
      };
    },
    methods: {
        exportCSV() {
            const csvData =
                'data:text/csv;charset=utf-8,' +
                Object.keys(this.auditLogs[0]).join(',') + '\n' +
                this.auditLogs.map(log => Object.values(log).join(',')).join('\n');
                const encodedUri = encodeURI(csvData);
                const link = document.createElement('a');
                link.setAttribute('href', encodedUri);
                link.setAttribute('download', 'audit_logs.csv');
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
        },
        exportExcel() {
            if (this.auditLogs.length === 0) {
                alert('No data to export.');
                return;
            }
            // Extracting keys from the first log object
            const keys = Object.keys(this.auditLogs[0]);
            if (keys.length === 0) {
                alert('Log objects have no keys.');
                return;
            }
            // Generating CSV content
            const csvContent =
                keys.join(',') + '\n' +
                this.auditLogs.map(log => keys.map(key => log[key]).join(',')).join('\n');
            // Creating a Blob
            const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
            // Creating a download link
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = 'audit_logs.csv';
            // Triggering the download
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        },
        loadData(){
            this.auditLogs = []
            axios({
                method:'get',
                url:'/getLogs',
            }).then(res=>{
                this.auditLogs = res.data.filter(x=>{
                    if(this.Title == x.TypeofLogs){
                        return x
                    }
                })
            });
        }
    },
    mounted () {
        this.loadData()
    },
};
  </script>
