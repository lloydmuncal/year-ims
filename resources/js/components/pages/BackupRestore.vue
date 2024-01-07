<template>
    <div class="container mx-auto p-4">
      <h1 class="text-2xl font-semibold mb-4">Backup and Restore</h1>
      <!-- Backup Table -->
      <div class="overflow-x-auto overflow-y-auto max-h-60 md:max-h-96">
        <table class="min-w-full bg-white border-4-gray-200 border-gray-300 border-4 shadow-xl">
            <thead>
            <tr>
                <th class="sticky top-0 bg-gray-400 p-2 border-2 text-center">YEARBOOK ID</th>
                <th class="sticky top-0 bg-gray-400 p-2 border-2 text-center">Title</th>
                <th class="sticky top-0 bg-gray-400 p-2 border-2 text-center">Batch</th>
                <th class="sticky top-0 bg-gray-400 p-2 border-2 text-center">Date</th>
                <th class="sticky top-0 bg-gray-400 p-2 border-2 text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(backup, index) in backups" :key="index">
                <td class="p-2 border-b text-center">{{ backup.Yearbook_id }}</td>
                <td class="p-2 border-b text-center">{{ backup.Title }}</td>
                <td class="p-2 border-b text-center">{{ backup.Batch }}</td>
                <td class="p-2 border-b text-center">{{ DateFromat(backup.deleted_at) }}</td>
                <td class="p-2 border-b text-center">
                <button @click="restoreBackup(backup)" class="bg-green-500 text-white px-2 py-1 rounded mr-2" title="Restore Yearbook">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="22" height="22">
                        <path d="M18.5374 19.5674C16.7844 21.0831 14.4993 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 14.1361 21.3302 16.1158 20.1892 17.7406L17 12H20C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20C14.1502 20 16.1022 19.1517 17.5398 17.7716L18.5374 19.5674Z" fill="rgba(255,255,255,1)"></path>
                    </svg>
                </button>
                <!-- <button @click="deleteBackup(backup)" class="bg-red-500 text-white px-2 py-1 rounded">
                    Delete
                </button> -->
                </td>
            </tr>
            </tbody>
        </table>
        </div>
    </div>
  </template>


  <script>
import moment from 'moment'
import { useUserStore } from '../../Store/mainStore'
import Swal from 'sweetalert2';
  export default {
    data() {
      return {
        backups: [],
        useStore:useUserStore(),
      };
    },
    methods: {
      backupData() {
        axios({
            methods:'GET',
            url:'/backup'
        }).then(res=>{
            console.log(res.data)
        })
      },
      restoreBackup(backupId) {

        Swal.fire({
            title: "Restore YearBook?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes"
            }).then((result) => {
            if (result.isConfirmed) {
                axios({
                    method:'post',
                    url:'/RestoreYearbook',
                    data:backupId
                }).then(res=>{
                    let obj={
                        FirstName:this.useStore.userData.FirstName,
                        SurName:this.useStore.userData.SurName,
                        LRN_No:this.useStore.userData.LRN_No,
                        Details:'Restored Yearbook Success'
                    }
                    axios({
                        method:'post',
                        url:'/ArchiveLogs',
                        data:obj
                    }).then(rex=>{})
                    Swal.fire({
                        title: "Success!",
                        text: "YearBook has been Restored.",
                        icon: "success"
                    });
                    this.getArchiveYB()
                })
            }
        })



      },

      DateFromat(date){
        return moment(date).format('YYYY-MM-DD H:mm:ss')
      },
      getArchiveYB(){
        axios({
            method:'get',
            url:'/getArchiveYearbook',
        }).then(res=>{
          this.backups = res.data
        })
      }
    },
    mounted(){
      this.getArchiveYB()
    }
  };
  </script>

  <style>
  /* Add any additional styles here */
  </style>
