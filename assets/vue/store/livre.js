import LivreApi from "../api/LivreApi";
import {setToken} from "../plugins/auth";

export default {
    namespaced: true,

    state: {
        livres:[],
        livre: {},
        maxPagination: 0,
        total: 0
    },

    mutations: {
        setLivres(state, {livres,total,maxPagination}) {
            state.livres = livres;
            state.total = total;
            state.maxPagination = maxPagination;
        },

        setLivre(state, livre){
            state.livre = livre;
        },

        addLivre(state, {livre,action}) {
            if(action == 'add'){
                state.livres.push(livre);
                state.total ++
            }else {
                const res = state.livres.find( item => item.id == livre.id )
                res.titlelivre = livre.titlelivre
                res.edition = livre.edition
                res.taille = livre.taille
            }
        },

        removeLivre(state, id) {
          let index = state.livres.findIndex(item => item.id == id)
          state.livres.splice(index,1)
          state.total --
        },

        setMaxPagination(state, maxPagination) {
            state.maxPagination = maxPagination;
        },

    },

    actions: {
        async allLivreAction({commit}, param) {
            const res = await LivreApi.allLivre(param)
            commit('setLivres', {
                livres: res.data.data.livres,
                total: res.data.data.total,
                maxPagination: res.data.data.maxPagination,
            })
        },

        async updateLivreAction({commit}, param){
            const res = await LivreApi.updateLivre(param)
            commit('addLivre', {
                livre: res.data.data.livre,
                action: res.data.data.action
            })
        },

        async removeLivreAction({commit}, param) {
            const res = await LivreApi.removeLivre(param)
            commit('removeLivre', res.data.data.id )
        }


    }

}