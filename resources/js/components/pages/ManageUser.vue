<template>
    <div>
        <!-- <div class="flex space-x-4 justify-center">
            <div
                v-for="(tab, index) in tabData"
                :key="index"
                @click="activeTab = index"
                :class="{
                'border-b-2 border-blue-500': activeTab === index,
                'cursor-pointer': activeTab !== index
                }"
                class="text-gray-600 text-xl hover:text-blue-500 px2 py2  border-gray-400  mt-14  "
            >
                 {{ tab.label }}
            </div>
        </div> -->
        <hr class="border-t border-gray-300">
        <div class="mt-4">
        <div v-if="activeTab === 0">
            <current-year-book   />
        </div>
        <div v-else-if="activeTab === 1">
            <!-- <manage-staff/> -->
        </div>
        </div>
    </div>
</template>



<script>
import CurrentYearBook from './MaanageUserSub/CurrentYearBook.vue'
// import ManageStaff from './MaanageUserSub/ManageStaff.vue'
        export default {
  components: { CurrentYearBook },
        data() {
            return {
                activeTab: 0,
                search:null,
                tabData: [
                    { id: "tab1", label: "Current Year" },
                    { id: "tab2", label: "STAFF" },
                ],
                UserList:null
            }
        },


}
</script>

<style lang="scss" scoped>

</style>
