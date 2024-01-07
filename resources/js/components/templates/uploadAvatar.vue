<template>
    <div class="fixed top-0 left-0 h-screen w-screen flex items-center justify-center bg-gray-900 bg-opacity-50">
          <div class="h-auto md:h-42 w-full xs:w-1/2 sm:w-1/2 md:w-1/2 lg:w-1/3 xl:w-1/4 mx-auto bg-white p-4 rounded-lg space-x-2 space-y-2">
                <div class="flex justify-between items-center   ">
                    <label for="file-upload" class="block text-gray-500 italic">Upload Avatar:</label>
                    <button @click="CloseDialog()" class="text-blue-500 hover:text-red-500 hover:underline">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  width="24" height="24">
                            <path d="M12.0007 10.5865L16.9504 5.63672L18.3646 7.05093L13.4149 12.0007L18.3646 16.9504L16.9504 18.3646L12.0007 13.4149L7.05093 18.3646L5.63672 16.9504L10.5865 12.0007L5.63672 7.05093L7.05093 5.63672L12.0007 10.5865Z"></path>
                        </svg>
                    </button>
                </div>
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <input
                        type="file"
                        id="file-upload"
                        class="border-2 border-gray-400  mb-2 md:mb-0 w-full "
                        @change="handleFile"
                        accept="image/*"
                    />
                    <button @click="ConfirmImage()"  class="border-2 px-2 py-2 bg-green-500 text-white font-bold text-sm rounded-xl w-full md:w-auto">
                        Confirm
                     </button>
                    </div>
            </div>
        </div>
</template>
<script>
    export default {
        data() {
            return {
                selectedFiles: []
            }
        },
        methods: {
            handleFile(event){
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
                            ext: ext,
                            overide: false,
                        }
                        self.selectedFiles.push(obj)
                    };
                }
                console.log(self.selectedFiles)

            },
            CloseDialog(){
                this.$emit('CloseDialog',false)
            },
            ConfirmImage(){
                let arr = this.selectedFiles.map(x=>{
                    return JSON.stringify(x)
                })
                axios({
                    method:'POST',
                    url:'/uploadAvatar',
                    data:{data:arr}
                }).then(res=>{
                    this.$emit('handleFileUpload', this.selectedFiles);
                    console.log(res.data)
                })
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>
