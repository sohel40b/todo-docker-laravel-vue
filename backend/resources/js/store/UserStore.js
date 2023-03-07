import { defineStore } from 'pinia';

export const UserStore = defineStore({
    id: 'UserStoreId',

    state: () => ({
        //define variables
        token : localStorage.getItem('token') || 0,
    }),
    getters:{
        // get state variable value
        getToken: state => state.token
    },
    actions:{
        // action to be performed
        setToken: function(token){
            this.token = token
            localStorage.setItem('token',token)
        },
        removeToken: function(){
            this.token = 0
            localStorage.removeItem('token')
        },
    },

});

export default UserStore;
