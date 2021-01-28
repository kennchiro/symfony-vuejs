import axiosService from '../plugins/axiosService'

export default {
    async allCar(param){
        return axiosService.post('/api/car/all',param)
    },
    async updateCar(param){
        return axiosService.post('/api/car/update',param)
    },
    async removeCar(param){
        return axiosService.post('/api/car/remove',param)
    },

}
