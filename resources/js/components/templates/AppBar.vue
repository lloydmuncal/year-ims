<template>
    <div>
        <div >
            <div class="bg-gray-400  text-white flex justify-between" >
                <!-- App Bar -->
                <div class="flex items-center p-2 ">
                    <button type="button" @click="categoryOpener" class="text-white  hover:text-gray-400  focus:outline-none focus:text-gray-400">
                        <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current">
                        <path  fill-rule="evenodd"
                            d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"
                        ></path>
                        </svg>
                    </button>
                </div>
                <div class="relative mx-2 my-2 z-50 flex justify-end">
                            <button @click="toggleDropdown()" @blur="closeDropdown()" class="flex items-center justify-end focus:outline-none">
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAMFBMVEXi4uKrq6vk5OSsrKyoqKjg4ODAwMDMzMza2tq6urqzs7PT09Ovr6/ExMS3t7fPz8+r7X/7AAAG30lEQVR4nO2dDXPbIAyGjRDg7/z/fzvA6eI0SWM7EpJzPLdlvWtv57cSSAIsmqZSqVQqlUqlUqlUKpVKpVKpVCqVSqVSqVQqlUqlcjbgEelHIsGljyymHcI0dXMfmWc/hUvbuvSNUyvNDx8/3DB1ozGIaDL5CzS296GNPyD9mJ8R5YWoLkqKioyxNv6JH1lnVtpPw1mtmB3QhfnHcK+I3/fDWTW2U7Te3/quzMGdzlsBWp/NZ9/KSz+BNrgTSUz+2Xbv3PO3t5rJJc920k+/BQdu2mS9Xxrn4SSuCjD0ZuMAvDOiwe4Urgqu263upjLoNyO041F9WaOXFvAOCPawBReJfavbisc99KYxgFpXTUNw7wz6TOJFr8AZ9weJZxInaSnPiXPM5y66KESv0YrQ9hT2y1iNEsH1FGPwCuKkTSIApcBkxTij6spR/c5M+w2xPh5UWRFCtCClDaPGsZVWdcPBQCruSq8n8IOjihP3eC3VogPPIhDjUFQi8cIiMDLqqBdjJGQSaJRERZi4TBhRUUq1fAItdhoqKZ5p5keivBGhpQ309wKN6aQF8powIp68QcuqL60wSivknEgT1oqOxDjRUSfcj0yyO1MDaVX4hOgioruo4NlNmOYaQYXOIrPEFDAkTXgxJMuHfzMKFhjOsytM/7tgSHQf7cJsRbDCYA/3V2Y5hWH/RugB0IoNRPDc0fCK2EAkXgV+TRBTiEW81EjtYgAwVvf39DKVPsBQSuEotIcBoZRClLGhK6hQaN2Uvfq9KZSpguHrFbIvQq0USoX8qvDsCuHrFX7/XFpW4ddHfAF9KR6WUmhRqnoqlHlbY4UUgitkQxRbqClVARuhCtg1wHZE4R6UW8UoE/JRcCUqlBAoeazm+1eESw1EyWPfvohCwZ0ZYDvRtkb0dFuRzScvuMsNJeKF6IkaV2BRGI3sgRqw7IcxhE9gxiqYVyHKnhjKB/eYz7VJn/riz02lT+41DXPm1sl3I+A1ooITtDFkcAoUH4UJmPgUSk+ki0BwPVfAkI6F/4mJDU/M6KWV/cAU9i1qeXsNmCphFD4dvCZmNvRGlFslfQbHmtSoYR69QR/34yBUpbABgn4RdwL1NVbIDRXoBAZpPU9oezqJmqbRG4Q9B9TkMr8AKkfVKvCzBkprgUHLC86PLKuLH+WoaEf5qv4v4DJ+9gIGzroC/SMfdqlBr3ESvQdgOvgyVMxtlXvoDzDMx8KGldyh2AW4cKCXC/bnMOACNH7nMQ3sg/4RuCZ199weNTDq09ECYwcOUofWTc6KOF9Opy8DAINPIp8uANil3WU03yRz8pAGAHfxudfug8jcD9rM03D+dtCxrgq+x4WrW+Yv5+lyZuutyR3YU8ty733XdT41LB/c9/Rlz8Cq73xz/ZR+Jlpg9W6Wu/unUqlUKpVmycmud5G4H5aY+C3xIoXCnNB0fT+O1tpx7OcupzWuOXtWk7O1MM15cSr/xf95d/qq76acvUk/5wGS/8UHjyn3/3T7VW0Yq6fhWh2eKZNLz9qG2W5Zyog/Mna5yjiPvqQw3TCzeRXDItpuaQelX2UuIoa9N5QstszFvvphmar641tQvm20e2u6oORo+y8bhy12LeiecS7bltf+IGtU6qvRfvNn6rIlk69qlJf3Rw3mq8c+215LzcrFXsd7CcSYTdkWK93Fokwk0Qb3TaKddM03cDG0NwfEHEDLZvAy75HcL/MLNAGcjgILWtLjUCsmHY4KQ+pDy9NZX8M1ZbmzAtuLQeLvBEUca/sPi+JnF1LrRGR79Sn7huAxzLQAwzXHrEDBDX7qMP8KsbOm0Ly9KZYGqa4RSWAJfYISizXCMjLTTbkuUSZNquXjYrkmUVkhmtLZDc8dVn+Ac1mJdHcdbpdYuNFQoe5CKywWrIkL9hNcg0MhfWkQkt+UtwFr+jL1MLC/oP6S/N5zCZVw8JAzgcQyuU3ZSLgm/l6LhAwpH00Uea8UOkGFJV5LLJ7M/KJn91MonszcE+M+62wKTZCaR69YdLwBw40Csf4O5F0mLloUvoKzVIwlhbQ85iIDjrzPRA7fOrgDEB6Di0BOI6owIVq25tfQEBxEIMCytSNwxe6VeUfPFRJFKvun8GSnrPfi7oOrBZhYXfgAy8YpV6ukY7AU++BQOOlewVIJyy1ePIMhJALoCIZXONzUqXHRTEdeQ+VuXopE0t9rWey+yo1Y+iX+FCs0aaQeiOVuc9zKTCtwub1ZFdQ3PXO2YT0E8c6+rpTtCulAdA0YXVNphLjlmeO+JX43tKkplLq8ajvx9027ra8q7U5YQ3xVmYa17nssOsJTmUVu6tgL8dEM0W3R5xBvluoLh5tLxH/TA10AET63TwAAAABJRU5ErkJggg==" class="w-10 h-10 rounded-full ring-1 ring-gray-300 dark:ring-gray-500" alt="User Avatar">
                            </button>
                    <div v-if="isDropdownOpen" class="absolute right-0 mt-12 w-52 border dark:border-gray-700 	 bg-white dark:bg-gray-800 rounded divide-y dark:divide-gray-700 divide-gray-100 shadow">
                        <div class="py-22 px-4 text-sm text-gray-900 dark:text-gray-200">
                            <div>Welcome:</div>
                            <div class="font-medium truncate">Julius Pahunang </div>
                        </div>
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownSmallButton">
                            <li><a href="#" class="block py-2 px-4 hover:bg-primary hover:text-white">User Profile</a></li>
                            <li><a href="#" class="block py-2 px-4 hover:bg-primary hover:text-white">Settings</a></li>
                        </ul>
                        <div class="  py-1">
                            <button @click="logout()" class="block flex ml-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-primary hover:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="12" height="12" class="mx-1 m-1">
                                <path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C15.2713 2 18.1757 3.57078 20.0002 5.99923L17.2909 5.99931C15.8807 4.75499 14.0285 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20C14.029 20 15.8816 19.2446 17.2919 17.9998L20.0009 17.9998C18.1765 20.4288 15.2717 22 12 22ZM19 16V13H11V11H19V8L24 12L19 16Z" fill="rgba(255,255,255,1)"></path>
                                </svg>
                                Sign out
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <nav
                :class="{ 'transform translate-x-0': open, 'transform -translate-x-full': !open }"
                class="fixed left-0 top-0 h-full bg-gray-700 text-white w-60 transition-transform duration-300 z-50"
                >
                <div class="flex justify-center items-center px-3 py-3 bg-gray-700 h-fit">
                    <div class="logo text-center py-4 ">
                        <img src="https://depedcavitecity.ph/wp-content/uploads/2019/09/spnhs-shs-294x300.png" alt="Logo" class="w-32 h-32 mx-auto">
                    </div>
                    <button @click="categoryOpener()" class="text-white rounded-full hover:bg-gray-600 focus:outline-none absolute top-3 right-3 z-50">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20ZM12 10.5858L14.8284 7.75736L16.2426 9.17157L13.4142 12L16.2426 14.8284L14.8284 16.2426L12 13.4142L9.17157 16.2426L7.75736 14.8284L10.5858 12L7.75736 9.17157L9.17157 7.75736L12 10.5858Z" fill="rgba(255,255,255,1)"></path>
                        </svg>
                    </button>
                </div>
                <hr class="border-t border-gray-300">
                <ul>
                    <li class="flex py-2 px-4  font-bold hover:bg-gray-500 " v-for="(data,i) in category" :key="i">
                        <a :href="data.to" class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" class="mt-1 mr-1">
                              <path :d="data.icon" fill="rgba(255,255,255,1)"></path>
                            </svg>
                          {{ data.title }}
                        </a>
                    </li>
                </ul>
            </nav> -->
            <nav
                :class="{ 'transform translate-x-0': open, 'transform -translate-x-full': !open }"
                class="fixed left-0 top-0 h-full bg-gray-700 text-white w-60 transition-transform duration-300 z-50"
                >
                <div class="flex justify-center items-center px-3 py-3 bg-gray-700 h-fit">
                    <div class="logo text-center py-4 ">
                        <img src="https://depedcavitecity.ph/wp-content/uploads/2019/09/spnhs-shs-294x300.png" alt="Logo" class="w-32 h-32 mx-auto">
                    </div>
                    <button @click="categoryOpener()" class="text-white rounded-full hover:bg-gray-600 focus:outline-none absolute top-3 right-3 z-50">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20ZM12 10.5858L14.8284 7.75736L16.2426 9.17157L13.4142 12L16.2426 14.8284L14.8284 16.2426L12 13.4142L9.17157 16.2426L7.75736 14.8284L10.5858 12L7.75736 9.17157L9.17157 7.75736L12 10.5858Z" fill="rgba(255,255,255,1)"></path>
                        </svg>
                    </button>
                </div>
                <hr class="border-t border-gray-300">
                <ul>
                    <li class="flex py-2 px-4  font-bold hover:bg-gray-500 " v-for="(data,i) in category" :key="i">
                        <a :href="data.to" class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" class="mt-1 mr-1">
                              <path :d="data.icon" fill="rgba(255,255,255,1)"></path>
                            </svg>
                          {{ data.title }}
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>
<script>
    import { useUserStore } from '../../Store/mainStore'
    export default{
        data() {
            return {
                isDropdownOpen: false,
                open:false,
                category:[
                    {title:'DASHBOARD',sub:false,btn:false,to:'/',icon:'M13 21V11H21V21H13ZM3 13V3H11V13H3ZM9 11V5H5V11H9ZM3 21V15H11V21H3ZM5 19H9V17H5V19ZM15 19H19V13H15V19ZM13 3H21V9H13V3ZM15 5V7H19V5H15Z'},
                    {title:'YEARBOOK',sub:false,btn:false,to:'/yearbook',icon:'M21 4H7C5.89543 4 5 4.89543 5 6C5 7.10457 5.89543 8 7 8H21V21C21 21.5523 20.5523 22 20 22H7C4.79086 22 3 20.2091 3 18V6C3 3.79086 4.79086 2 7 2H20C20.5523 2 21 2.44772 21 3V4ZM5 18C5 19.1046 5.89543 20 7 20H19V10H7C6.27143 10 5.58835 9.80521 5 9.46487V18ZM20 7H7C6.44772 7 6 6.55228 6 6C6 5.44772 6.44772 5 7 5H20V7Z'},
                    {title:'MANAGE USERS',sub:true,btn:false,to:'/manageuser',icon:'M12 14V16C8.68629 16 6 18.6863 6 22H4C4 17.5817 7.58172 14 12 14ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13ZM12 11C14.21 11 16 9.21 16 7C16 4.79 14.21 3 12 3C9.79 3 8 4.79 8 7C8 9.21 9.79 11 12 11ZM14.5946 18.8115C14.5327 18.5511 14.5 18.2794 14.5 18C14.5 17.7207 14.5327 17.449 14.5945 17.1886L13.6029 16.6161L14.6029 14.884L15.5952 15.4569C15.9883 15.0851 16.4676 14.8034 17 14.6449V13.5H19V14.6449C19.5324 14.8034 20.0116 15.0851 20.4047 15.4569L21.3971 14.8839L22.3972 16.616L21.4055 17.1885C21.4673 17.449 21.5 17.7207 21.5 18C21.5 18.2793 21.4673 18.551 21.4055 18.8114L22.3972 19.3839L21.3972 21.116L20.4048 20.543C20.0117 20.9149 19.5325 21.1966 19.0001 21.355V22.5H17.0001V21.3551C16.4677 21.1967 15.9884 20.915 15.5953 20.5431L14.603 21.1161L13.6029 19.384L14.5946 18.8115ZM18 19.5C18.8284 19.5 19.5 18.8284 19.5 18C19.5 17.1716 18.8284 16.5 18 16.5C17.1716 16.5 16.5 17.1716 16.5 18C16.5 18.8284 17.1716 19.5 18 19.5Z'},
                    {title:'AUDIT TRAILS',sub:true,btn:false,to:'/audit',icon:'M12.4142 5H21C21.5523 5 22 5.44772 22 6V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3H10.4142L12.4142 5ZM4 5V19H20V7H11.5858L9.58579 5H4ZM12 9V13H16C16 15.2091 14.2091 17 12 17C9.79086 17 8 15.2091 8 13C8 10.7909 9.79086 9 12 9Z'},
                    {title:'BACKUP & RESTORE',sub:true,btn:false,to:'/backup',icon:'M5.46257 4.43262C7.21556 2.91688 9.5007 2 12 2C17.5228 2 22 6.47715 22 12C22 14.1361 21.3302 16.1158 20.1892 17.7406L17 12H20C20 7.58172 16.4183 4 12 4C9.84982 4 7.89777 4.84827 6.46023 6.22842L5.46257 4.43262ZM18.5374 19.5674C16.7844 21.0831 14.4993 22 12 22C6.47715 22 2 17.5228 2 12C2 9.86386 2.66979 7.88416 3.8108 6.25944L7 12H4C4 16.4183 7.58172 20 12 20C14.1502 20 16.1022 19.1517 17.5398 17.7716L18.5374 19.5674Z'},
                    {title:'SETTINGS',sub:true,btn:false,to:'/settings',icon:'M3.33946 17.0002C2.90721 16.2515 2.58277 15.4702 2.36133 14.6741C3.3338 14.1779 3.99972 13.1668 3.99972 12.0002C3.99972 10.8345 3.3348 9.824 2.36353 9.32741C2.81025 7.71651 3.65857 6.21627 4.86474 4.99001C5.7807 5.58416 6.98935 5.65534 7.99972 5.072C9.01009 4.48866 9.55277 3.40635 9.4962 2.31604C11.1613 1.8846 12.8847 1.90004 14.5031 2.31862C14.4475 3.40806 14.9901 4.48912 15.9997 5.072C17.0101 5.65532 18.2187 5.58416 19.1346 4.99007C19.7133 5.57986 20.2277 6.25151 20.66 7.00021C21.0922 7.7489 21.4167 8.53025 21.6381 9.32628C20.6656 9.82247 19.9997 10.8336 19.9997 12.0002C19.9997 13.166 20.6646 14.1764 21.6359 14.673C21.1892 16.2839 20.3409 17.7841 19.1347 19.0104C18.2187 18.4163 17.0101 18.3451 15.9997 18.9284C14.9893 19.5117 14.4467 20.5941 14.5032 21.6844C12.8382 22.1158 11.1148 22.1004 9.49633 21.6818C9.55191 20.5923 9.00929 19.5113 7.99972 18.9284C6.98938 18.3451 5.78079 18.4162 4.86484 19.0103C4.28617 18.4205 3.77172 17.7489 3.33946 17.0002ZM8.99972 17.1964C10.0911 17.8265 10.8749 18.8227 11.2503 19.9659C11.7486 20.0133 12.2502 20.014 12.7486 19.9675C13.1238 18.8237 13.9078 17.8268 14.9997 17.1964C16.0916 16.5659 17.347 16.3855 18.5252 16.6324C18.8146 16.224 19.0648 15.7892 19.2729 15.334C18.4706 14.4373 17.9997 13.2604 17.9997 12.0002C17.9997 10.74 18.4706 9.5632 19.2729 8.6665C19.1688 8.4405 19.0538 8.21822 18.9279 8.00021C18.802 7.78219 18.667 7.57148 18.5233 7.36842C17.3457 7.61476 16.0911 7.43414 14.9997 6.80405C13.9083 6.17395 13.1246 5.17768 12.7491 4.03455C12.2509 3.98714 11.7492 3.98646 11.2509 4.03292C10.8756 5.17671 10.0916 6.17364 8.99972 6.80405C7.9078 7.43447 6.65245 7.61494 5.47428 7.36803C5.18485 7.77641 4.93463 8.21117 4.72656 8.66637C5.52881 9.56311 5.99972 10.74 5.99972 12.0002C5.99972 13.2604 5.52883 14.4372 4.72656 15.3339C4.83067 15.5599 4.94564 15.7822 5.07152 16.0002C5.19739 16.2182 5.3324 16.4289 5.47612 16.632C6.65377 16.3857 7.90838 16.5663 8.99972 17.1964ZM11.9997 15.0002C10.3429 15.0002 8.99972 13.6571 8.99972 12.0002C8.99972 10.3434 10.3429 9.00021 11.9997 9.00021C13.6566 9.00021 14.9997 10.3434 14.9997 12.0002C14.9997 13.6571 13.6566 15.0002 11.9997 15.0002ZM11.9997 13.0002C12.552 13.0002 12.9997 12.5525 12.9997 12.0002C12.9997 11.4479 12.552 11.0002 11.9997 11.0002C11.4474 11.0002 10.9997 11.4479 10.9997 12.0002C10.9997 12.5525 11.4474 13.0002 11.9997 13.0002Z'},
                ],
                useStore:useUserStore()
            }
        },
        methods: {
            toggleDropdown() {
                this.isDropdownOpen = !this.isDropdownOpen
            },
            categoryOpener(){
                this.open = !this.open
            },
            closeDropdown(){
                alert('asdasd')
            },
            logout(){
                this.useStore.clearUser()
                this.$router.push('/login')
            },
        },
        mounted() {
        },
    }
</script>

<style>

</style>
