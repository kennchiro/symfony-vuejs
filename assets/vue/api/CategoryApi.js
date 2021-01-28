import axiosService from '../plugins/axiosService'

export default {
    async allCategory(param) {
        return axiosService.post('/api/category/all', param)
    },
    async updateCategory(param) {
        return axiosService.post('/api/category/update', param)
    },
    async removeCategory(param) {
        return axiosService.post('/api/category/remove', param)
    },
}