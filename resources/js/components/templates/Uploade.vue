<template>
    <div class="fixed top-0 left-0 h-screen w-screen flex items-center justify-center bg-gray-900 bg-opacity-50">
          <div class="h-auto md:h-42 w-full xs:w-1/2 sm:w-1/2 md:w-1/2 lg:w-1/3 xl:w-1/4 mx-auto bg-white p-4 rounded-lg space-x-2 space-y-2">
                <div class="flex justify-between items-center">
                    <label for="file-upload" class="block text-gray-500 italic">Upload {{title}} Image:</label>
                    <button @click="CloseDialog()" class="text-blue-500 hover:text-red-500 hover:underline">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  width="24" height="24">
                            <path d="M12.0007 10.5865L16.9504 5.63672L18.3646 7.05093L13.4149 12.0007L18.3646 16.9504L16.9504 18.3646L12.0007 13.4149L7.05093 18.3646L5.63672 16.9504L10.5865 12.0007L5.63672 7.05093L7.05093 5.63672L12.0007 10.5865Z"></path>
                        </svg>
                    </button>
                </div>
                <div class="flex flex-col md:flex-row justify-between items-center ">
                    <input
                        type="file"
                        id="file-upload"
                        class="border-2 border-gray-400 mb-2 md:mb-0 w-full"
                        @change="handleFile"
                        multiple
                        accept="image/*"
                    />
                </div>
                <div v-if="selectedFiles.length > 0 ">
                    {{ 'Total Image File: '+ selectedFiles.length }}
                </div>
                <div class="flex justify-end">
                    <button @click="ConfirmImage()" class="border-2 px-2 py-2 bg-green-500 text-white font-bold text-sm rounded-xl w-full md:w-auto"> Confirm</button>
                </div>
            </div>
        </div>
  </template>

  <script>
  export default {
    props:['activeTab','title'],
    data() {
      return {
        selectedFiles: [],
      };
    },
    methods: {
        handleFile(event){
                this.selectedFiles =[]
                let file = Array.from(event.target.files)
                let self = this
                for (let i = 0; i < file.length; i++) {
                    const reader = new FileReader();
                    let fileNameArr = file[i].name.split(".");
                    let ext = fileNameArr[fileNameArr.length - 1];
                    reader.readAsDataURL(file[i]);
                    reader.onloadend = function() {
                        let obj = {
                            data: reader.result,
                            filename: file[i].name,
                            name:file[i].name.split('.')[0],
                            ext: ext,
                            overide: false,
                            path:null
                        }
                        self.selectedFiles.push(obj)
                    };
                }
            },
            CloseDialog(){
                this.$emit('CloseDialog',false)
            },
            ConfirmImage(){
                let arr = JSON.stringify( this.selectedFiles)
                if(this.activeTab ==0){
                    axios({
                        method:'POST',
                        url:'/uploadCover',
                        data:{data:arr}
                    }).then(res=>{
                        this.$emit('handleFileUpload', res.data);
                    })
                }else if(this.activeTab ==1){
                    axios({
                        method:'POST',
                        url:'/uploadBackGround',
                        data:{data:arr}
                    }).then(res=>{
                        this.$emit('handleFileUpload', res.data);
                    })
                }
            },
            clearFilename(item){
                console.log(item)
            }
    },
    watch:{

    }

  };
  </script>

  <style lang="scss" scoped>
  </style>
