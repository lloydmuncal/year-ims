// stores/user.js
import { defineStore } from 'pinia';
import { inject } from 'vue';
export const useUserStore = defineStore({
  id: 'user',
  state: () => ({
    userData: null,
    avatar:null,
    // apiUrl:'test',
    api:inject('apiUrl'),

  }),
    actions: {
        setUser(userData) {
            this.userData = JSON.stringify(userData);
            localStorage.setItem('userData', window.btoa(this.userData));
        },
        clearUser() {
            this.userData = null;
            localStorage.removeItem('userData');
        },
        initializeUser() {
            let value =localStorage.getItem('userData')
            if(value){
                const userData = JSON.parse(window.atob(value));
                if (userData) {
                    this.userData = userData;
                }
            }
        },
        UserDetails() {
            const userData =   JSON.parse(window.atob(localStorage.getItem('userData')));
            return userData
        },
        setAvatar(avatar) {
            if(avatar){
                this.avatar=`${this.api}:8000/get_avatar/${avatar}`
            }else{
                this.avatar ="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png"
            }
            localStorage.setItem('avatar', this.avatar);
        },
        getAvatar(){
            let avatar =localStorage.getItem('avatar')
            if(avatar){
                this.avatar = avatar
            }
        },
        clearAvatar() {
            this.avatar = null;
            localStorage.removeItem('avatar');
        },
    },
});
