<template>
    <div >
      <!-- Sidebar with Dimmer -->
      <div   class="fixed"  :class="open ? 'z-50':''">
        <!-- Sidebar -->
        <div  class="  text-white transition-all" :class="[right ? 'right-0' : 'left-0']">
          <div ref="content"  class=" duration-700 overflow-hidden bg-gray-700 bg-opacity-90  h-screen z-50"    :class="[open ? 'w-48 sm:w-48 md:w-52 lg:w-56 xl:w-64': 'w-0']">
          <!-- Sidebar Header -->
            <div class="flex justify-between px-3 py-3 bg-gray-900 h-fit">
                <div class=" text-2xl font-bold">Navigation</div>
                <button @click="toggle" class="text-white  rounded-full hover:bg-gray-600 focus:outline-none z-50"  >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20ZM12 10.5858L14.8284 7.75736L16.2426 9.17157L13.4142 12L16.2426 14.8284L14.8284 16.2426L12 13.4142L9.17157 16.2426L7.75736 14.8284L10.5858 12L7.75736 9.17157L9.17157 7.75736L12 10.5858Z" fill="rgba(255,255,255,1)"></path>
                    </svg>
                </button>
            </div>
            <!-- Navigation Links -->
            <ul class="py-4 ">
              <li class=" py-2 px-4 hover:bg-gray-700 font-bold  " v-for="(item,i) in category" :key="i">
                <div class="flex justify-between">
                  <a :href="item.to" class="flex">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" class="mt-1 mr-1">
                        <path :d="item.icon" fill="rgba(255,255,255,1)"></path>
                      </svg>
                    {{ item.title }}
                  </a>
                  <button v-if="item.sub==true" @click="item.btn=!item.btn">
                      <svg   xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" class="mt-1">
                        <path v-if="item.btn==false" d="M11.9997 13.1714L16.9495 8.22168L18.3637 9.63589L11.9997 15.9999L5.63574 9.63589L7.04996 8.22168L11.9997 13.1714Z" fill="rgba(255,255,255,1)"></path>
                        <path v-else d="M11.9997 10.8284L7.04996 15.7782L5.63574 14.364L11.9997 8L18.3637 14.364L16.9495 15.7782L11.9997 10.8284Z" fill="rgba(255,255,255,1)"></path>
                      </svg>
                    </button>
                  </div>
                  <!-- <div v-if="item.btn==true">
                    <ul class="py-4 ">
                      <li class="flex py-2 px-4  font-bold hover:bg-gray-500 " v-for="(data,i) in subcategory" :key="i">
                        <a :href="data.to" class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" class="mt-1 mr-1">
                              <path :d="data.icon" fill="rgba(255,255,255,1)"></path>
                            </svg>
                          {{ data.title }}
                        </a>
                      </li>
                    </ul>
                  </div> -->
                </li>
            </ul>
          </div>
        </div>
        <transition name="fade">
          <div
            v-if="dimmer && open"
            @click="toggle"
            class="flex-1 bg-gray-400 bg-opacity-75 active:outline-none z-50"
          ></div>

        </transition>
      </div>
    </div>
  </template>
    <script>
        export default {
            props:['open'],
            data() {
                return {
                    dimmer: true,
                    right:false,
                    category:[
                        {title:'Home',sub:false,btn:false,to:'/',icon:'M13 21V11H21V21H13ZM3 13V3H11V13H3ZM9 11V5H5V11H9ZM3 21V15H11V21H3ZM5 19H9V17H5V19ZM15 19H19V13H15V19ZM13 3H21V9H13V3ZM15 5V7H19V5H15Z'},
                        {title:'Company',sub:false,btn:false,to:'/about',icon:'M4 5V19H20V7H11.5858L9.58579 5H4ZM12.4142 5H21C21.5523 5 22 5.44772 22 6V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3H10.4142L12.4142 5Z'},
                    ]
                }
            },
        }
    </script>
  <style>
  html {
    background: #efefef;
  }

  .fade-enter-active,
  .fade-leave-active {
    transition: opacity 5s ease-out;
  }

  .fade-enter,
  .fade-leave-to {
    opacity: 0;
  }
  </style>
