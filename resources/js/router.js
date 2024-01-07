
import { createRouter, createWebHistory } from 'vue-router'
import { useUserStore } from '../js/Store/mainStore.js';
const Home = () => import('./components/pages/Home.vue');
const Login= () => import('./components/pages/Login.vue');
const YearBook= () => import('./components/pages/YearBook.vue');
const AuditTrails= () => import('./components/pages/AuditTrails.vue');
const ManageUser= () => import('./components/pages/ManageUser.vue');
const BackupRestore= () => import('./components/pages/BackupRestore.vue');
const Settings= () => import('./components/pages/Settings.vue');
const MasterRecords= () => import('./components/pages/MasterRecords.vue');
const BackgroundUpload= () => import('./components/pages/YearBookSub/UploadBackground.vue');
const TestPage= () => import('./components/pages/TestPage.vue');





const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            component: Home,
            name: 'Home',
        },
        {
            path: '/yearbook',
            component: YearBook,
            name: 'YearBook',
        },
        {
            path: '/login',
            component: Login,
            name: 'Login',
        },
        {
            path: '/manageuser',
            component: ManageUser,
            name: 'ManageUser',
        },
        {
            path: '/background',
            component: BackgroundUpload,
            name: 'BackgroundUpload',
        },
        {
            path: '/audit',
            component: AuditTrails,
            name: 'AuditTrails',
        },
        {
            path: '/backuprestore',
            component: BackupRestore,
            name: 'BackupRestore',
        },
        {
            path: '/settings',
            component: Settings,
            name: 'Settings',
        },
        {
            path: '/masterrecords',
            component: MasterRecords,
            name: 'MasterRecords',
        },
        {
            path: '/testpage',
            component: TestPage,
            name: 'TestPage',
        },



    ]
});


router.beforeEach((to, from, next) => {
    const userStore = useUserStore(); // Access the UserStore
        if (to.path === '/login') {
            if (userStore.userData != null) {
                next('/')
            }
            else {
                next()
             }
        } else {
            if (userStore.userData != null) {
                next()
            } else {
             next('/login')
            }
        }
});


export default router;
