
import {setToken} from "../plugins/auth";
import CarApi from "../api/CarApi";

export default {
    namespaced: true,
    state:{
        cars: [],
        car: {},
        maxPagination: 0,
        total: 0,
        isAdd: false
    },

    mutations:{
        setIsAdd(state, isAdd) {
            state.isAdd = isAdd;
            },

        setCars(state, {cars,total,maxPagination}) {
            state.cars = cars;
            state.total = total;
            state.maxPagination = maxPagination;
        },
        setCar(state,car){
            state.car = car
        },
        addCar(state, {car,action}) {
            if(action === 'add'){
                state.cars.push(car);
                state.total ++
            }else {
                const res = state.cars.find(item => item.id === car.id)
                res.name = car.name
                res.type = car.type
            }
        },

        removeCar(state,id){
            let index = state.cars.findIndex(item => item.id === id )
            state.cars.splice(index,1)
            state.total --
        },

        setMaxPagination(state,maxPagination){
            state.maxPagination = maxPagination
        },


    },
    actions: {
        async allCarAction({commit},param){
            const res = await CarApi.allCar(param)
            commit('setCars', {
                cars: res.data.data.cars,
                total: res.data.data.total,
                maxPagination: res.data.data.maxPagination
            })
        },
        async updateCarAction({commit},param){
            const res = await CarApi.updateCar(param)
            commit('addCar', {car: res.data.data.car, action: res.data.data.action})
        },
        async removeCarAction({commit},param){
            const res = await CarApi.removeCar(param)
            commit('removeCar', res.data.data.id)
        },
    }
}
