import mutations from "@/store/modules/auth/mutations";
import actions from "@/store/modules/auth/actions";
import getters from "@/store/modules/auth/getters";
export default {
    namespaced: true,
    state() {
        return {
            // userId: null,
            // token: null,
            // didAutoLogout: false
            name: 'INGD',
        };
    },
    mutations,
    actions,
    getters
}