<template>
    <div class="h-screen">
        <div class=" flex justify-end right-0 mt-3 space-x-1 ">
            <button title="Generate PDF" @click="printOutput()"  class="   right-0 bottom-19 border-4 border-gray-400 p-1 bg-gray-300 rounded-full" >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="36" height="36">
                    <path d="M17 2C17.5523 2 18 2.44772 18 3V7H21C21.5523 7 22 7.44772 22 8V18C22 18.5523 21.5523 19 21 19H18V21C18 21.5523 17.5523 22 17 22H7C6.44772 22 6 21.5523 6 21V19H3C2.44772 19 2 18.5523 2 18V8C2 7.44772 2.44772 7 3 7H6V3C6 2.44772 6.44772 2 7 2H17ZM16 17H8V20H16V17ZM20 9H4V17H6V16C6 15.4477 6.44772 15 7 15H17C17.5523 15 18 15.4477 18 16V17H20V9ZM8 10V12H5V10H8ZM16 4H8V7H16V4Z"></path>
                </svg>
            </button>
            <button  v-show=" useStore.userData.UserType!='User'" title="Upload Image" @click="BulkUpload()"  class=" right-0 bottom-16 border-4 border-gray-200 p-1 bg-blue-300 rounded-full" >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="36" height="36">
                    <path d="M21 15V18H24V20H21V23H19V20H16V18H19V15H21ZM21.0082 3C21.556 3 22 3.44495 22 3.9934V13H20V5H4V18.999L14 9L17 12V14.829L14 11.8284L6.827 19H14V21H2.9918C2.44405 21 2 20.5551 2 20.0066V3.9934C2 3.44476 2.45531 3 2.9918 3H21.0082ZM8 7C9.10457 7 10 7.89543 10 9C10 10.1046 9.10457 11 8 11C6.89543 11 6 10.1046 6 9C6 7.89543 6.89543 7 8 7Z" fill="rgba(255,255,255,1)"></path>
                </svg>
            </button>

            <button  v-show=" useStore.userData.UserType!='User'" title="ADD PAGE'S" @click="Addpage()"  class="   right-0 bottom-16 border-4 border-gray-400 p-1 bg-blue-800 rounded-full" >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="36" height="36">
                    <path d="M11 11V7H13V11H17V13H13V17H11V13H7V11H11ZM12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20Z" fill="rgba(255,255,255,1)"></path>
                </svg>
            </button>
            <button v-show=" useStore.userData.UserType!='User'" title="SAVE" @click="saveYearBook()" class="   right-0 bottom-2 border-4 border-gray-500 p-2 bg-green-400 rounded-full" >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                    <path d="M18 19H19V6.82843L17.1716 5H16V9H7V5H5V19H6V12H18V19ZM4 3H18L20.7071 5.70711C20.8946 5.89464 21 6.149 21 6.41421V20C21 20.5523 20.5523 21 20 21H4C3.44772 21 3 20.5523 3 20V4C3 3.44772 3.44772 3 4 3ZM8 14V19H16V14H8Z " fill="rgba(255,255,255,1)"></path>
                </svg>
            </button>
            <button title="Return to YearBook" @click="BacktoBookPreview()" class=" top-0 right-0 border-4 px-4 bg-red-400 text-xl fornt-semibold rounded-full" >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="36" height="36">
                    <path d="M5.82843 6.99955L8.36396 9.53509L6.94975 10.9493L2 5.99955L6.94975 1.0498L8.36396 2.46402L5.82843 4.99955H13C17.4183 4.99955 21 8.58127 21 12.9996C21 17.4178 17.4183 20.9996 13 20.9996H4V18.9996H13C16.3137 18.9996 19 16.3133 19 12.9996C19 9.68584 16.3137 6.99955 13 6.99955H5.82843Z" fill="rgba(255,255,255,1)"></path>
                </svg>
            </button>
        </div>
        <div class="flex justify-center items-center  "  >
        <div class="w-fit overflow-x-auto ">
            <!-- border-2 border-gray-500 bg-gray-300 -->
            <div  class="section z-45 w-fit px-1 flex "   v-if="currentPage > 3">
                <h1 class="text-md font-bold italic font-serif">{{ items.NoOfPage[currentPage][0][0].Section}}</h1>
            </div>
            <div  class="section2 z-45 w-fit px-1 flex "   v-if="currentPage > 3">
                <button @click="deletePage()"> 
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 10.5858L9.17157 7.75736L7.75736 9.17157L10.5858 12L7.75736 14.8284L9.17157 16.2426L12 13.4142L14.8284 16.2426L16.2426 14.8284L13.4142 12L16.2426 9.17157L14.8284 7.75736L12 10.5858Z" fill="rgba(237,16,16,1)"></path></svg>
                </button>
            </div>
            <div v-else class="mt-7 section">
                
            </div>
            <div class="flex">
                <button @click="prevPage" class="   top-1/2 left-0 transform-translate-y-1/2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48"><path d="M10.8284 12.0007L15.7782 16.9504L14.364 18.3646L8 12.0007L14.364 5.63672L15.7782 7.05093L10.8284 12.0007Z" fill="rgba(70,146,221,1)"></path>
                    </svg>
                </button>
               
                <div class="items-center border-4  bg-gray-400">
                    <div>
                        <div class="overflow-x-auto ">
                            <div class="flex justify-center   ">
                                <template v-for="(page,i) in items.NoOfPage" :key="i" >
                                    <div  v-for="(data,x) in page" :key="x" class="  space-x-4">
                                            <div v-if="currentPage === i " class="page border-4 bg-cover bg-center  h-120 w-96 " :style=" { 'background-image': ` url('${api}:8000/get_bg/${i>3 ?items.SelectedBackground : Frontpage(i) }')` }">
                                          
                                                <div v-if="i >3" class="slot relative overflow-hidden border-2 left-[40px] top-[70px] mt-4 rounded-md h-[190px]  w-[140px] ">
                                                    <button v-if="data[0].url != null &&  useStore.userData.UserType!='User'" @click="clearImg(i,x,0)" class=" absolute top-0 right-0 m-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  width="24" height="24" >
                                                            <path d="M12.0007 10.5865L16.9504 5.63672L18.3646 7.05093L13.4149 12.0007L18.3646 16.9504L16.9504 18.3646L12.0007 13.4149L7.05093 18.3646L5.63672 16.9504L10.5865 12.0007L5.63672 7.05093L7.05093 5.63672L12.0007 10.5865Z"></path>
                                                        </svg>
                                                    </button>
                                                    <button v-if="data[0].url != null &&  useStore.userData.UserType!='User' " @click="ViewImage(data[0])"  class=" absolute top-0 left-0 m-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  width="24" height="24" >
                                                            <path d="M18.031 16.6168L22.3137 20.8995L20.8995 22.3137L16.6168 18.031C15.0769 19.263 13.124 20 11 20C6.032 20 2 15.968 2 11C2 6.032 6.032 2 11 2C15.968 2 20 6.032 20 11C20 13.124 19.263 15.0769 18.031 16.6168ZM16.0247 15.8748C17.2475 14.6146 18 12.8956 18 11C18 7.1325 14.8675 4 11 4C7.1325 4 4 7.1325 4 11C4 14.8675 7.1325 18 11 18C12.8956 18 14.6146 17.2475 15.8748 16.0247L16.0247 15.8748ZM12.1779 7.17624C11.4834 7.48982 11 8.18846 11 9C11 10.1046 11.8954 11 13 11C13.8115 11 14.5102 10.5166 14.8238 9.82212C14.9383 10.1945 15 10.59 15 11C15 13.2091 13.2091 15 11 15C8.79086 15 7 13.2091 7 11C7 8.79086 8.79086 7 11 7C11.41 7 11.8055 7.06167 12.1779 7.17624Z" fill="rgba(255,255,255,1)"></path>
                                                        </svg>
                                                    </button>
                                                    <input
                                                        v-model="data[0].Name"
                                                        placeholder="StudentName"
                                                        :disabled="useStore.userData.UserType == 'User' ? true : false "
                                                        class="absolute bottom-0 left-1/2 transform -translate-x-1/2 p-1  text-center text-[11px]  border-t-0 border-r-0 border-l-0 border-b-2 border-gray-500 rounded-none bg-gray-800 bg-opacity-50 text-white"
                                                    >
                                                    <img  @click="useStore.userData.UserType == 'User' ? ViewImage(data[0]) : uploadImage(i,x,0)" :src="data[0].url ? data[0].url : this.noImage " alt="Image 1" class="w-full h-full object-cover rounded-md">
                                                </div>
                                                <div v-if="i >3" class="slot relative overflow-hidden border-2  top-[70px] left-[8px] mt-4   rounded-md h-[190px] w-[140px] ">
                                                    <button v-if="data[1].url != null &&  useStore.userData.UserType!='User'" @click="clearImg(i,x,1)" class=" absolute top-0 right-0 m-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  width="24" height="24">
                                                            <path d="M12.0007 10.5865L16.9504 5.63672L18.3646 7.05093L13.4149 12.0007L18.3646 16.9504L16.9504 18.3646L12.0007 13.4149L7.05093 18.3646L5.63672 16.9504L10.5865 12.0007L5.63672 7.05093L7.05093 5.63672L12.0007 10.5865Z"></path>
                                                        </svg>
                                                    </button>
                                                    <button v-if="data[1].url != null&&  useStore.userData.UserType!='User' "  @click="ViewImage(data[1])" class=" absolute top-0 left-0 m-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  width="24" height="24" >
                                                            <path d="M18.031 16.6168L22.3137 20.8995L20.8995 22.3137L16.6168 18.031C15.0769 19.263 13.124 20 11 20C6.032 20 2 15.968 2 11C2 6.032 6.032 2 11 2C15.968 2 20 6.032 20 11C20 13.124 19.263 15.0769 18.031 16.6168ZM16.0247 15.8748C17.2475 14.6146 18 12.8956 18 11C18 7.1325 14.8675 4 11 4C7.1325 4 4 7.1325 4 11C4 14.8675 7.1325 18 11 18C12.8956 18 14.6146 17.2475 15.8748 16.0247L16.0247 15.8748ZM12.1779 7.17624C11.4834 7.48982 11 8.18846 11 9C11 10.1046 11.8954 11 13 11C13.8115 11 14.5102 10.5166 14.8238 9.82212C14.9383 10.1945 15 10.59 15 11C15 13.2091 13.2091 15 11 15C8.79086 15 7 13.2091 7 11C7 8.79086 8.79086 7 11 7C11.41 7 11.8055 7.06167 12.1779 7.17624Z" fill="rgba(255,255,255,1)"></path>
                                                        </svg>
                                                    </button>
                                                    <input
                                                        v-model="data[1].Name"
                                                        placeholder="StudentName"
                                                        :disabled="useStore.userData.UserType == 'User' ? true : false "
                                                        class="absolute bottom-0 left-1/2 transform -translate-x-1/2 p-1  text-center text-[11px]  border-t-0 border-r-0 border-l-0 border-b-2 border-gray-500 rounded-none bg-gray-800 bg-opacity-50 text-white"
                                                    >
                                                    <img @click="useStore.userData.UserType == 'User' ?ViewImage(data[1]): uploadImage(i,x,1)" :src="data[1].url ? data[1].url : this.noImage" alt="Image 2" class="w-full h-full object-cover rounded-md">
                                                </div>
                                                <div v-if="i >3" class="slot relative overflow-hidden border-2   rounded-md top-5 left-[40px] h-[190px]    w-[140px]   ">
                                                    <button v-if="data[2].url != null &&  useStore.userData.UserType!='User'" @click="clearImg(i,x,2)" class=" absolute top-0 right-0 m-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  width="24" height="24">
                                                            <path d="M12.0007 10.5865L16.9504 5.63672L18.3646 7.05093L13.4149 12.0007L18.3646 16.9504L16.9504 18.3646L12.0007 13.4149L7.05093 18.3646L5.63672 16.9504L10.5865 12.0007L5.63672 7.05093L7.05093 5.63672L12.0007 10.5865Z"></path>
                                                        </svg>
                                                    </button>
                                                    <button v-if="data[2].url != null &&  useStore.userData.UserType!='User' "  @click="ViewImage(data[2])"  class=" absolute top-0 left-0 m-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  width="24" height="24" >
                                                            <path d="M18.031 16.6168L22.3137 20.8995L20.8995 22.3137L16.6168 18.031C15.0769 19.263 13.124 20 11 20C6.032 20 2 15.968 2 11C2 6.032 6.032 2 11 2C15.968 2 20 6.032 20 11C20 13.124 19.263 15.0769 18.031 16.6168ZM16.0247 15.8748C17.2475 14.6146 18 12.8956 18 11C18 7.1325 14.8675 4 11 4C7.1325 4 4 7.1325 4 11C4 14.8675 7.1325 18 11 18C12.8956 18 14.6146 17.2475 15.8748 16.0247L16.0247 15.8748ZM12.1779 7.17624C11.4834 7.48982 11 8.18846 11 9C11 10.1046 11.8954 11 13 11C13.8115 11 14.5102 10.5166 14.8238 9.82212C14.9383 10.1945 15 10.59 15 11C15 13.2091 13.2091 15 11 15C8.79086 15 7 13.2091 7 11C7 8.79086 8.79086 7 11 7C11.41 7 11.8055 7.06167 12.1779 7.17624Z" fill="rgba(255,255,255,1)"></path>
                                                        </svg>
                                                    </button>
                                                    <input
                                                        v-model="data[2].Name"
                                                        placeholder="StudentName"
                                                        :disabled="useStore.userData.UserType == 'User' ? true : false "
                                                        class="absolute bottom-0 left-1/2 transform -translate-x-1/2 p-1  text-center text-[11px]  border-t-0 border-r-0 border-l-0 border-b-2 border-gray-500 rounded-none bg-gray-800 bg-opacity-50 text-white"
                                                    >
                                                    <img @click="useStore.userData.UserType == 'User' ? ViewImage(data[2]): uploadImage(i,x,2)"   :src="data[2].url ? data[2].url : this.noImage " alt="Image 3" class="w-full h-full object-cover rounded-md">
                                                </div>
                                                <div v-if="i >3" class="slot relative overflow-hidden border-2  rounded-md top-5 left-[8px]  h-[190px]    w-[140px] ">
                                                    <button v-if="data[3].url != null &&  useStore.userData.UserType!='User'" @click="clearImg(i,x,3)" class=" absolute top-0 right-0 m-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  width="24" height="24">
                                                            <path d="M12.0007 10.5865L16.9504 5.63672L18.3646 7.05093L13.4149 12.0007L18.3646 16.9504L16.9504 18.3646L12.0007 13.4149L7.05093 18.3646L5.63672 16.9504L10.5865 12.0007L5.63672 7.05093L7.05093 5.63672L12.0007 10.5865Z"></path>
                                                        </svg>
                                                    </button>
                                                    <button v-if="data[3].url != null &&  useStore.userData.UserType!='User'" @click="ViewImage(data[3])"  class=" absolute top-0 left-0 m-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  width="24" height="24" >
                                                            <path d="M18.031 16.6168L22.3137 20.8995L20.8995 22.3137L16.6168 18.031C15.0769 19.263 13.124 20 11 20C6.032 20 2 15.968 2 11C2 6.032 6.032 2 11 2C15.968 2 20 6.032 20 11C20 13.124 19.263 15.0769 18.031 16.6168ZM16.0247 15.8748C17.2475 14.6146 18 12.8956 18 11C18 7.1325 14.8675 4 11 4C7.1325 4 4 7.1325 4 11C4 14.8675 7.1325 18 11 18C12.8956 18 14.6146 17.2475 15.8748 16.0247L16.0247 15.8748ZM12.1779 7.17624C11.4834 7.48982 11 8.18846 11 9C11 10.1046 11.8954 11 13 11C13.8115 11 14.5102 10.5166 14.8238 9.82212C14.9383 10.1945 15 10.59 15 11C15 13.2091 13.2091 15 11 15C8.79086 15 7 13.2091 7 11C7 8.79086 8.79086 7 11 7C11.41 7 11.8055 7.06167 12.1779 7.17624Z" fill="rgba(255,255,255,1)"></path>
                                                        </svg>
                                                    </button>
                                                    <input
                                                        v-model="data[3].Name"
                                                        placeholder="StudentName"
                                                        :disabled="useStore.userData.UserType == 'User' ? true : false "
                                                        class="absolute bottom-0 left-1/2 transform -translate-x-1/2 p-1  text-center text-[11px]  border-t-0 border-r-0 border-l-0 border-b-2 border-gray-500 rounded-none bg-gray-800 bg-opacity-50 text-white"
                                                    >
                                                    <img @click="useStore.userData.UserType == 'User' ? ViewImage(data[3]) :uploadImage(i,x,3)"  :src="data[3].url ? data[3].url : this.noImage" alt="Image 4" class="w-full h-full object-cover rounded-md">
                                                </div>
                                            </div>
                                        <div  v-if="currentPage === i && data" class="text-center text-sm font-bold italic">
                                            {{( x+i)+1 }}
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
                <button @click="nextPage" class="   top-1/2 right-0 transform-translate-y-1/2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48">
                        <path d="M13.1714 12.0007L8.22168 7.05093L9.63589 5.63672L15.9999 12.0007L9.63589 18.3646L8.22168 16.9504L13.1714 12.0007Z" fill="rgba(70,146,221,1)"></path>
                    </svg>
                </button>
            </div>
        </div>
            <div v-if="uploadDialog">
                <upload-dialog  @handleFileUpload="handleFileUpload"  @CloseDialog="ClsDialog()"/>
            </div>
            <div v-if="BulkuploadDialog">
                <!-- <uploade @handleFileUpload="handleBulkUpload"  @CloseDialog="ClsDialog2()" /> -->
                <bulk-upload :bulkHolder="bulkHolder" @handleFileUpload="handleBulkUpload"  @CloseDialog="ClsDialog2()"/>
            </div>
            <div v-if="additionalPage">
                <div  class="fixed top-0 left-0 h-screen w-screen flex items-center justify-center bg-gray-900 bg-opacity-40 z-50">
                    <!-- <div class="bg-white p-4">
                        <div class="flex justify-end  " >
                            <button @click="additionalPage=false" class="text-blue-500 hover:underline">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  width="24" height="24">
                                    <path d="M12.0007 10.5865L16.9504 5.63672L18.3646 7.05093L13.4149 12.0007L18.3646 16.9504L16.9504 18.3646L12.0007 13.4149L7.05093 18.3646L5.63672 16.9504L10.5865 12.0007L5.63672 7.05093L7.05093 5.63672L12.0007 10.5865Z"></path>
                                </svg>
                            </button>
                        </div>
                        <h1 class="font-semibold text-xl mb-3">Add Page:</h1>
                        <div class="w-96">
                            <label for="Section" class="block text-gray-500 ">Section:</label>
                            <select id="Section" v-model="Section" class="border-2  bg-gray-300  p-2  w-full ">
                                <option value="" disabled>Select Section</option>
                                <option v-for="sec in sections" :key="sec.SectionName" >{{ sec.SectionName}}</option>
                            </select>
                        </div>
                        <div class="w-96">
                            <label for="NoOfPages"  class="block text-gray-500 ">No Of Pages:</label>
                            <select id="NoOfPages" v-model="noofpage" class="border-2  bg-gray-300 p-2 w-full">
                                <option value="" disabled selected >No of Pages</option>
                                <option v-for="(item,i) in 10" :key="i"  >{{ `${i+1}` }}</option>
                            </select>
                        </div>
                        <div class="flex justify-between mt-4">
                            <button  @click="NoofPage(noofpage)" class="bg-gray-800 text-white px-2 text-lg font-semibold rounded-xl block w-24 ">Next</button>
                        </div>
                    </div> -->
                    <div class="bg-white p-4  mx-auto">
                        <div class="flex justify-end">
                            <button @click="additionalPage=false" class="text-blue-500 hover:underline">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                    <path d="M12.0007 10.5865L16.9504 5.63672L18.3646 7.05093L13.4149 12.0007L18.3646 16.9504L16.9504 18.3646L12.0007 13.4149L7.05093 18.3646L5.63672 16.9504L10.5865 12.0007L5.63672 7.05093L7.05093 5.63672L12.0007 10.5865Z"></path>
                                </svg>
                            </button>
                        </div>
                        <h1 class="font-semibold text-xl mb-3">Add Page:</h1>
                        <div class="w-full md:w-96 mb-4">
                            <label for="Section" class="block text-gray-500">Section:</label>
                            <select id="Section" v-model="Section" class="border-2 bg-gray-300 p-2 w-full">
                                <option value="" disabled>Select Section</option>
                                <option v-for="sec in sections" :key="sec.SectionName" >{{ sec.SectionName}}</option>
                            </select>
                        </div>
                        <div class="w-full md:w-96 mb-4">
                            <label for="NoOfPages" class="block text-gray-500">No Of Pages:</label>
                            <select id="NoOfPages" v-model="noofpage" class="border-2 bg-gray-300 p-2 w-full">
                                <option value="" disabled selected >No of Pages</option>
                                <option v-for="(item,i) in 10" :key="i"  >{{ `${i+1}` }}</option>
                            </select>
                        </div>
                        <div class="flex justify-end mt-4">
                            <button @click="NoofPage(noofpage)" class="bg-gray-800 text-white px-2 text-lg font-semibold rounded-xl block w-full md:w-24">Next</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div v-if="viewImagedialog">
            <zoom-image :imgObj="imgObj" @CloseViewImage="CloseViewImage"/>
        </div>
    </div>
</template>
  <script>
import UploadDialog from '../../templates/UploadDialog.vue';
import { inject } from 'vue';
import Swal from 'sweetalert2';
import ZoomImage from './ZoomImage.vue';
import BulkUpload from '../../templates/BulkUpload.vue';
import { useUserStore } from '../../../Store/mainStore'
  export default {
  components: { UploadDialog, ZoomImage, BulkUpload,  },
  props:['items'],
    data() {
      return {
        useStore:useUserStore(),
        currentPage: 0,
        pages:[ ],
        window:window,
        imgs:'page1.PNG',
        uploadDialog:false,
        Page:-1,
        Gallery:-1,
        pic:-1,
        BookArr:[],
        additionalPage:false,
        Section:null,
        api:inject('apiUrl'),
        sections:[],
        imgObj:{},viewImagedialog:false,
        BulkuploadDialog:false,
        bulkHolder:[],
        noImage:``,
      };
    },
    methods: {
        Frontpage(i){
            return `page${i}.PNG`
        },
        getAllSection() {
                axios({
                    method:'get',
                    url:'/getAllSection'
                }).then(res=>{
                    this.sections=res.data
                })
            },
        printOutput() {
            this.items.tempNoPage= this.items.NoOfPage.flat().slice(4)
            axios({
                method: 'post',
                url: '/generatePdf',
                data: this.items,
                responseType: 'arraybuffer',
            }).then(response => {
                const blob = new Blob([response.data], { type: 'application/pdf' });
                const url = URL.createObjectURL(blob);
                window.open(url, '_blank');
                let obj={
                    FirstName:this.useStore.userData.FirstName,
                    SurName:this.useStore.userData.SurName,
                    LRN_No:this.useStore.userData.LRN_No,
                    Details:'Generate PDF Success'
                }
                axios({
                    method:'post',
                    url:'/DownloadLogs',
                    data:obj
                }).then(rex=>{})
            }).catch(error => {
                console.error('Error fetching PDF:', error);
            });
            axios({
                method: 'post',
                url: '/testprint',
                data: this.items,
                responseType: 'arraybuffer',
            }).then(response => {
                const blob = new Blob([response.data], { type: 'application/pdf' });
                const url = URL.createObjectURL(blob);
                window.open(url, '_blank');
                console.log(response.data)
            }).catch(error => {
                console.error('Error fetching PDF:', error);
            });
        },
        prevPage() {
            this.currentPage = Math.max(0, this.currentPage - 1);
        },
        nextPage() {
            this.currentPage = Math.min(this.items.NoOfPage.length - 1, this.currentPage + 1);
        },
        uploadImage(index1,index2,index3){
            this.uploadDialog=true
            this.Page=index1
            this.Gallery=index2
            this.pic=index3
        },
        handleFileUpload(val){
            this.items.NoOfPage[this.Page][this.Gallery][this.pic].Title=this.items.title
            this.items.NoOfPage[this.Page][this.Gallery][this.pic].Batch=this.items.Batch
            this.items.NoOfPage[this.Page][this.Gallery][this.pic].SelectedCover=this.items.SelectedCover
            this.items.NoOfPage[this.Page][this.Gallery][this.pic].SelectedBackground=this.items.SelectedBackground
            this.items.NoOfPage[this.Page][this.Gallery][this.pic].Section=this.items.Section
            this.items.NoOfPage[this.Page][this.Gallery][this.pic].Name=null
            this.items.NoOfPage[this.Page][this.Gallery][this.pic].EXT= val[0]  && val[0].ext ? val[0].ext: this.items.EXT
            this.items.NoOfPage[this.Page][this.Gallery][this.pic].Overide=val[0] && val[0].overide ? val[0].overide  : this.items.Overide
            this.items.NoOfPage[this.Page][this.Gallery][this.pic].FileName=val[0]  &&  val[0].filename ? val[0].filename : this.items.FileName
            this.items.NoOfPage[this.Page][this.Gallery][this.pic].Page=this.Page
            this.items.NoOfPage[this.Page][this.Gallery][this.pic].Gallery=this.Gallery
            this.items.NoOfPage[this.Page][this.Gallery][this.pic].pic=this.pic
            this.items.NoOfPage[this.Page][this.Gallery][this.pic].Yearbook_id=this.items.Yearbook_id
            this.items.NoOfPage[this.Page][this.Gallery][this.pic].url = `${this.api}:8000/get_img/${val[0].filename}`
            this.uploadDialog=false
        },
        BulkUpload(){

            let holder= [...this.items.NoOfPage]
            this.bulkHolder = holder.splice(4).flat().flat()
            this.BulkuploadDialog=true
        },
        handleBulkUpload(val){
            try {
                for (let i = 0; i < val.length; i++) {
                    if(val[i].Page ){
                        this.items.NoOfPage[val[i].Page][val[i].Gallery][val[i].pic].FileName=val[i].filename
                        this.items.NoOfPage[val[i].Page][val[i].Gallery][val[i].pic].Overide=val[i].overide
                        this.items.NoOfPage[val[i].Page][val[i].Gallery][val[i].pic].EXT=val[i].ext
                        this.items.NoOfPage[val[i].Page][val[i].Gallery][val[i].pic].url = `${this.api}:8000/get_img/${val[i].filename}`
                        console.log(this.items.NoOfPage[val[i].Page][val[i].Gallery][val[i].pic])
                    }
                }
                this.BulkuploadDialog=false
            } catch (error) {
                alert(error.message)
            }


        },
        ClsDialog(val){
            this.uploadDialog=val
        },
        ClsDialog2(val){
            this.BulkuploadDialog=val
        },
        clearImg(i1,i2,i3){
            this.items.NoOfPage[i1][i2][i3].url = this.noImage
            this.items.NoOfPage[i1][i2][i3].FileName = null
            this.items.NoOfPage[i1][i2][i3].EXT = null
            this.items.NoOfPage[i1][i2][i3].Overide = null
        },
        ViewImage(data){
            this.viewImagedialog =true
            this.imgObj = data
        },
        CloseViewImage(val){
            this.viewImagedialog =val
        },
        saveYearBook(){
            this.BookArr=[...this.items.NoOfPage]
            let toSave=this.BookArr.splice(4)
            axios({
                method:'post',
                url:'/insertYearBook',
                data:{data:toSave.flat().flat()}
            }).then(res=>{
                Swal.fire({
                    title:`${res.data}`,
                    icon: "success"
                });
               this.$emit('CloseUploading',false)
            }).catch(err=>{
                alert(err.message)
            })

        },
        Addpage(){
            this.additionalPage=true
            this.Section=null
        },
        NoofPage(index){
            let newPAge= this.items.NoOfPage.flat().length-1
            console.log(newPAge ,'newPAge')
            for (let i = 0; i <= index-1; i++) {
                this.items.NoOfPage.push(
                    [
                        [
                            {
                                url:this.noImage,
                                FileName:'NoImage.PNG',
                                EXT:'PNG',
                                Overide:null,
                                Title:this.items.title,
                                Batch:this.items.Batch,
                                Name:null,
                                SelectedCover:this.items.SelectedCover,
                                SelectedBackground:this.items.SelectedBackground,
                                Section:this.Section,
                                Page:newPAge  + (i+1),
                                Gallery:0,
                                pic:0,
                                Yearbook_id:this.items.Yearbook_id
                            },
                            {
                                url:this.noImage,
                                FileName:'NoImage.PNG',
                                EXT:'PNG',
                                Overide:null,
                                Title:this.items.title,
                                Page:newPAge  + (i+1),
                                Gallery:0,
                                pic:1,
                                Batch:this.items.Batch,
                                Name:null,
                                SelectedCover:this.items.SelectedCover,
                                SelectedBackground:this.items.SelectedBackground,
                                Section:this.Section,
                                Yearbook_id:this.items.Yearbook_id
                            },
                            {
                                url:this.noImage,
                                FileName:'NoImage.PNG',
                                EXT:'PNG',
                                Overide:null,
                                Title:this.items.title,
                                Batch:this.items.Batch,
                                Name:null,
                                SelectedCover:this.items.SelectedCover,
                                SelectedBackground:this.items.SelectedBackground,
                                Section:this.Section,
                                Page:newPAge  + (i+1),
                                Gallery:0,
                                pic:2,
                                Yearbook_id:this.items.Yearbook_id
                            },
                            {
                                url:this.noImage,
                                FileName:'NoImage.PNG',
                                EXT:'PNG',
                                Overide:null,
                                Batch:this.items.Batch,
                                Title:this.items.title,
                                Name:null,
                                SelectedCover:this.items.SelectedCover,
                                SelectedBackground:this.items.SelectedBackground,
                                Section:this.Section,
                                Page:newPAge  + (i+1),
                                Gallery:0,
                                pic:3,
                                Yearbook_id:this.items.Yearbook_id
                            },
                        ],
                    ]
                )
            }
            this.additionalPage=false
            this.Section=null
        },
        deletePage(){
            this.items.NoOfPage.splice(this.currentPage,1)
            this.currentPage =this.currentPage -1
            for (let i = 0; i <  this.items.NoOfPage.length; i++) {
                for (let y = 0; y < this.items.NoOfPage[i].length; y++) {
                    for (let x = 0; x < this.items.NoOfPage[i][y].length; x++) {
                        if(i >3){
                         this.items.NoOfPage[i][y][x].Page = i
                        }
                        console.log(this.items.NoOfPage[i][y][x])
                    }
                }
            }
        },
        BacktoBookPreview(){
            this.BookArr=[]
            this.pages=[],
            this.$emit('CloseUploading',false)
        },
    },
    mounted () {
        this.noImage=`${this.api}:8000/get_img/NoImage.PNG`,
        this.BookArr=[]
        this.getAllSection()
    },
  };
  </script>

  <style scoped>
  /* Add your custom styles here if needed */
  .outer-plane{
    width: 100%;
    height: 90%;
    display: block;
    /* overflow: hidden; */
  }
  .plane{
    /* background-color:rgba(123,125,124,0.8); */
    /* overflow: hidden; */
    width: 100%;
    height: 100%;
  }
  .book-page{
    /* display: inline-block; */
    /* overflow: hidden; */
    /* z-index: 3; */
  }
  .fade-in-out {
    opacity: 1;
    transition: opacity 0.5s;
  }

  .fade-in-out-enter, .fade-in-out-leave-to /* .fade-in-out-leave-active in <2.1.8 */ {
    opacity: 0;
  }
  .section {
    position: relative;
    top: 140px;
    left: 145px;
  }

  .section2 {
    position: relative;
    top: 35px;
    left: 460px;
  }


  </style>
