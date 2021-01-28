import axiosService from "../plugins/axiosService";

export default {

    async allLivre(param){
        return axiosService.post('/api/livre/all',param)
    },

    async updateLivre(param){
        return axiosService.post('/api/livre/update',param)
    },

    async removeLivre(param) {
        return axiosService.post('/api/livre/remove',param)
    }

}