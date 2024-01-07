<template>
    <div class="fixed top-0 left-0 h-screen w-screen flex items-center justify-center bg-gray-500 bg-opacity-90 z-50">
        <div class="border-4 max-w-96 p-6 bg-gray-500 rounded-xl">
            <div class="flex justify-end ">
                <button @click="CloseImage()" >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  width="42" height="42">
                        <path d="M12.0007 10.5865L16.9504 5.63672L18.3646 7.05093L13.4149 12.0007L18.3646 16.9504L16.9504 18.3646L12.0007 13.4149L7.05093 18.3646L5.63672 16.9504L10.5865 12.0007L5.63672 7.05093L7.05093 5.63672L12.0007 10.5865Z"></path>
                    </svg>
                </button>
            </div>
            <div class="w-80 h-22 border-4 border-gray-800">
                <img :src="imgObj.url" alt="Your Image" class="mx-auto h-full w-full object-contain">
            </div>
            <div class="text-center mt-4">
                <h1 class="texl-5xl italic text-white" >{{ this.imgObj.Name }}</h1>
            </div>
        </div>


    </div>
</template>
<script>
    export default {
        props:['imgObj'],
        data() {
            return {
                key: false
            }
        },
        methods:{
            CloseImage(){
                this.$emit('CloseViewImage',false)
            }
        },
        mounted () {
            console.log(this.imgObj,'imgObj');
        },
    }

</script>

<style lang="scss" scoped>

</style>
