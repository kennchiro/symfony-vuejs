
import CommentApi from "../api/CommentApi"

export default {
    namespaced: true,
    state:{
        comments: [],
        comment: {},
        maxPagination: 0,
        total: 0,
        articles: [],
        isAdd: false
    },
    mutations:{
        setIsAdd(state,isAdd){
            state.isAdd = isAdd
        },

        setComments(state, {comments,total,maxPagination,articles}) {
            state.comments = comments;
            state.total = total;
            state.maxPagination = maxPagination;
            state.articles = articles;
        },

        setComment(state,comment){
            state.comment = comment
        },

        addComment(state, {comment,action}) {
            if(action == 'add'){
                state.comments.push(comment);
                state.total ++
            }else {
                const res = state.comments.find(item => item.id == comment.id)
                res.persocom = comment.persocom
                res.article = comment.article
                res.textcom = comment.textcom
                res.datecom = comment.datecom
            }
        },
        setMaxPagination(state,maxPagination){
            state.maxPagination = maxPagination
        },
        removeComment(state,id){
            let index = state.comments.findIndex(item => item.id === id )
            state.comments.splice(index,1)
            state.total --
        },
    },
    actions: {
        async allCommentAction({commit},param){
            const res = await CommentApi.allComment(param)
            const payload = {
                comments: res.data.data.comments,
                total: res.data.data.total,
                maxPagination: res.data.data.maxPagination,
                articles: res.data.data.articles,
            }
            commit('setComments', payload)
        },
        async updateCommentAction({commit},param){
            const res = await CommentApi.updateComment(param)
            commit('addComment', {comment: res.data.data.comment, action: res.data.data.action})
        },
        async removeCommentAction({commit},param){
            const res = await CommentApi.removeComment(param)
            commit('removeComment', res.data.data.id)
        },
    }

}
