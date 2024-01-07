<template>
    <div class="fixed top-0 left-0 h-screen w-screen flex items-center justify-center bg-gray-900 bg-opacity-50">
            <div class="w-max md:w-auto lg:max bg-white p-4 rounded-lg space-y-4">
                <div class="flex justify-between items-center">
                    <label for="file-upload" class="block text-gray-500 italic">Bulk Upload:
                        <span class="italic text-sm underline"> Select Section first</span>
                    </label>

                    <button @click="CloseDialog()" class="text-blue-500 hover:text-red-500 hover:underline">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path d="M12.0007 10.5865L16.9504 5.63672L18.3646 7.05093L13.4149 12.0007L18.3646 16.9504L16.9504 18.3646L12.0007 13.4149L7.05093 18.3646L5.63672 16.9504L10.5865 12.0007L5.63672 7.05093L7.05093 5.63672L12.0007 10.5865Z"></path>
                        </svg>
                    </button>
                </div>
                <div class="flex flex-col md:flex-row items-center">
                    <label for="section" class="block text-sm font-medium text-gray-600 md:mr-2">Section</label>
                    <select id="section" name="section" v-model="SectionHlder" @change="SectionSelected()" class="p-2 rounded border border-gray-300 w-full md:w-1/2">
                        <option value="" disabled>Select Section</option>
                        <option v-for="sec in Section" :key="sec">{{ sec }}</option>
                    </select>
                </div>
                <div class="flex flex-col md:flex-row justify-between items-center mt-2" >
                    <input
                        type="file"
                        id="file-upload"
                        class="border-2 border-gray-400 mb-2 md:mb-0 w-full md:w-auto md:mr-2"
                        @change="handleFile"
                        multiple
                        accept="image/*"
                        :disabled="SectionHlder === null ? true:false"
                    />
                    <button @click="ConfirmImage()"
                    :disabled="SectionHlder === null ? true:false"
                    :class="{ 'bg-gray-400': SectionHlder === null , 'bg-green-500': SectionHlder !== null }"
                     class="border-2 px-2 py-2 text-white font-bold text-sm rounded-xl w-full md:w-auto">
                        Confirm
                    </button>
                </div>
                <div v-if="selectedFiles">
                    {{ 'Total Image Files: ' + selectedFiles.length }}
                </div>
            </div>

        </div>
</template>
<script>
    export default {
        props:['bulkHolder'],
        data() {
            return {
                selectedFiles: [],
                Section:[],
                SectionHlder:null,
                arrHolder:[]
            }
        },
        methods: {
            SectionSelected(){
                this.arrHolder=[]
                this.arrHolder=this.bulkHolder.filter(x=>{
                        if(x.Section == this.SectionHlder){
                            return x
                        }
                })
                console.log( this.arrHolder)

            },
            handleFile(event){
                let file = Array.from(event.target.files)
                let self = this
                self.selectedFiles=[]
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

            },
            CloseDialog(){
                this.$emit('CloseDialog',false)
            },
            ConfirmImage(){
                let arr = this.selectedFiles.map((x,i)=>{
                    return JSON.stringify(x)
                })
                    this.selectedFiles.filter((x,i)=>{
                        if(this.arrHolder[i]){
                            x.Page=this.arrHolder[i].Page
                            x.Gallery=this.arrHolder[i].Gallery
                            x.pic=this.arrHolder[i].pic
                        }
                    })
                axios({
                    method:'POST',
                    url:'/uploadImage',
                    data:{data:arr}
                }).then(res=>{
                    this.$emit('handleFileUpload', this.selectedFiles);
                })
            }
        },
        mounted() {
            this.Section =this.bulkHolder.reduce((total,item)=>{
                let index = total.findIndex(x=> x ==item.Section)
                if(index == -1){
                    total.push(item.Section)
                    return total
                }else{
                    return total
                }

            },[])
            console.log(this.Section.flat())
        },
        watch:{

        }
    }
</script>

<style lang="scss" scoped>

</style>
