import Vue from 'vue'
import Vuex from 'vuex'
import UserModule from './user'
import OtherModule from './other'
import DocModule from './doc'
import AuthorModule from './author'
import ArticleModule from './article'
import LivreModule from './livre'
import CarModule from  './car'
import CommentModule from './comment'
import CategoryModule from'./category'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        user: UserModule,
        other: OtherModule,
        doc: DocModule,
        author: AuthorModule,
        article: ArticleModule,
        livre: LivreModule,
        car: CarModule,
        comment: CommentModule,
        category: CategoryModule
    }
})
