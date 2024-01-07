<template>
    <div>
        <div class="container mx-auto rounded relative p-4  ">
            <div class="flex space-x-4 justify-start">
                <div
                    v-for="(tab, index) in tabData"
                    :key="index"
                    @click="activeTab = index ; index==0 ? title ='Cover': title ='Background'"
                    :class="{
                    ' bg-gray-600 text-white border-4': activeTab === index,
                    'cursor-pointer': activeTab !== index
                    }"
                    class="text-gray-600 text-lg font-bold hover:bg-gray-300   hover:border-4   px-2 "
                >
                    {{ tab.label }}
                </div>
            </div>
            <div class="border-2 border-gray-600 "></div>
            <div v-if="activeTab==0">
                <track-record/>
            </div>
            <div v-if="activeTab==1">
                <section-record />
            </div>
            <div v-if="activeTab==2">
                <student-record/>
            </div>
        </div>
    </div>
</template>
<script>
import SectionRecord from './MasterRecordSub/SectionRecord.vue'
import StudentRecord from './MasterRecordSub/StudentRecord.vue'
import TrackRecord from './MasterRecordSub/TrackRecord.vue'
    export default {
  components: { TrackRecord, SectionRecord, StudentRecord },
        data() {
            return {
                activeTab:0,
                tabData: [
                    { id: "tab1", label: "Track Records"  } ,
                    { id: "tab2", label: "Section Records" },
                    { id: "tab2", label: "Student Records" }
                ]
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>
