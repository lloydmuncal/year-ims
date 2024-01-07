<template>
    <div class="h-fit">
        <div class="flex flex-col px-3" >
            <div class="w-full md:w-5/8  order-2  md:flex-row py-10  ">
                <div class="container mx-auto rounded relative  shadow-xl">
                    <div class="p-2 flex flex-col md:flex-row md:items-center justify-between">
                        <h1 class="text-2xl font-bold ml-4 mb-2 md:mb-0">YEARBOOK</h1>
                    <input
                        v-model="search"
                        type="text"
                        placeholder="Search items"
                        class="w-full md:w-1/4 h-10 rounded p-2 text-black focus:outline-none focus:ring focus:ring-blue-200 border-2 border-black"
                    />
                    </div>
                <div class="max-h-[500px] overflow-y-auto  space-y-2 ">
                    <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-5 ">
                        <div v-for="(item, i) in 10" :key="i" class=" px-4 py-4 w-fit">
                            <div  class="  rounded-lg border-2 border-gray-600 shadow-xl px-4 py-4 items-center">
                                <img src="https://i.pinimg.com/originals/1a/a3/01/1aa3018f9581075eba30bfca10b81605.jpg" alt="yearbook" >
                                <div class="flex justify-between">
                                    <h1>Batch 2023</h1>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" class="mt-1">
                                        <path d="M12.4142 5H21C21.5523 5 22 5.44772 22 6V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3H10.4142L12.4142 5ZM4 5V19H20V7H11.5858L9.58579 5H4ZM13 13H16L12 17L8 13H11V9H13V13Z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <button @click="AddBook()" class="bg-gray-800 text-white text-2xl w-fit px-2 -py-2 rounded-md flex absolute bottom-0 right-0 m-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="26" height="26" class="pt-2">
                    <path d="M11 11V7H13V11H17V13H13V17H11V13H7V11H11ZM12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20Z" fill="rgba(255,255,255,1)"></path>
                </svg>
                    ADD BOOK
                </button>
        </div>
        <div v-if="showAddBook" >
            <create-book @CloseDialog="CloseAddBook"/>
        </div>
        <!-- ======================================================================================================================= -->
      </div>
    </div>
</template>

<script>
import CreateBook from "./CreateBook.vue"

    export default{
        components: { CreateBook },
        data() {
            return {
                key: false,
                filteredItems:[],
                showAddBook:false,
            }
        },
        methods: {
            AddBook() {
                this.showAddBook = !this.showAddBook
            },
            CloseAddBook(val){
                this.showAddBook =val
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>
