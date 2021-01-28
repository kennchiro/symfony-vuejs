import CategoryApi from "../api/CategoryApi";
import {setToken} from "../plugins/auth";

export default {
    namespaced: true,
    state:{
        categorys: [],
        category: {},
        maxPagination: 0,
        total: 0,
        isAdd: false
    },

    mutations: {
        setCategorys(state, {categorys,total,maxPagination}){
            state.categorys = categorys;
            state.total = total;
            state.maxPagination = maxPagination;
        },

        setCategory(state,category){
            state.category = category
        },

        setIsAdd(state, isAdd) {
            state.isAdd = isAdd;
        },

        addCategory(state, {category,action}){
            if(action == 'add'){
                state.categorys.push(category);
                state.total++
            }else {
                const res = state.categorys.find(item => item.id == category.id)
                res.nomcat = category.nomcat
            }
        },

        removeCategory(state,id) {
           let index = state.categorys.findIndex(item => item.id == id)
            state.categorys.slice(index,1)
            state.total--
        },

        setMaxPagination(state,maxPagination){
            state.maxPagination = maxPagination
        },
    },

    actions: {
        async allCategoryAction({commit},param) {
            const res = await CategoryApi.allCategory(param)
            commit('setCategorys', {
                categorys: res.data.data.categorys,
                total: res.data.data.total,
                maxPagination: res.data.data.maxPagination
            })
        },

        async updateCategoryAction({commit},param){
            const res = await CategoryApi.updateCategory(param)
            commit('addCategory', {
                category: res.data.data.category,
                action: res.data.data.action
            })
        },

        async removeCategoryAction({commit},param) {
            const res = await CategoryApi.removeCategory(param)
            commit('removeCategory', res.data.data.id)
        }

    }

}