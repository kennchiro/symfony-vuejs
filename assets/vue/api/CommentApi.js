import axiosService from '../plugins/axiosService'

export default {
    async allComment(param){
        return axiosService.post('/api/comment/all',param)
    },
    async updateComment(param){
        return axiosService.post('/api/comment/update',param)
    },
    async removeComment(param){
        return axiosService.post('/api/comment/remove',param)
    },

}
