<template>
  <div style="margin-top: -15px">

    <mdb-edge-header color="teal darken-5">
      <div class="category-page-background"></div>
    </mdb-edge-header>

<!--        <ul v-for="(comment,index) in comments" :key="index">-->
<!--          <li> {{ comment.persocom }} </li>-->
<!--          <li> {{ comment.datecom }} </li>-->
<!--        </ul>-->

<!--        <ul v-for="category in categorys">-->
<!--          <li> {{ category.nomcat }} </li>-->
<!--        </ul>-->

    <bird-container>
      <h1 class="pb-4">
        <mdb-icon far icon="newspaper" color="red"/>
        <strong> Listes Articles</strong>
        <div style="display: flex;float: right">
<!--          <mdb-btn @click="goTo('/author')"  color="default"> Author </mdb-btn>-->
          <mdb-btn @click="goTo('/article')" color="default"> Article </mdb-btn>
<!--          <mdb-btn @click="goTo('/comment')"   color="default"> Comment </mdb-btn>-->
        </div>
      </h1>

      <br>
                <detail-category :category="category" v-if="$route.params.id"></detail-category>
                <div class="row" v-else>
                  <template v-for="category in categorys">

                      <mdb-card style="margin-left: 8px;">
                        <!--              <mdb-card-image src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20%286%29.jpg" alt="Card image cap"></mdb-card-image>-->
                        <mdb-card-body>
                          <mdb-card-title> {{category.nomcat}} </mdb-card-title>
                          <!--                        <mdb-card-text> Author : {{ comment.article.author.name }}</mdb-card-text>-->
                          <el-button  @click="goToCategoryListArticle(category)" type="primary" icon="el-icon-arrow-right" size="small"> show more </el-button>
                        </mdb-card-body>
                      </mdb-card>


                  </template>
                </div>

      <br> <br>
      <!--     Pour voir tous les articles         -->
      <detail :article="article" v-if="$route.params.id"> </detail>
      <mdb-list-group v-else>
        <template v-for="article in articles">
          <mdb-nav-item  :key="article.id"
                         class="list-group-item list-group-item-action"
                         @click="goToArticle(article)">
            <h5 class="justify-content-between d-flex align-items-center">
              {{article.title}}
              <span style="font-size: 9px"> Author: {{ article.author.name }} </span>
              <span>  </span>
              <mdb-icon icon="angle-right"/>
            </h5>
          </mdb-nav-item>
        </template>
      </mdb-list-group>

      <br><br>

      <div class="block" v-if="!$route.params.id">
        <el-pagination
            background
            @size-change="handleSizeChange"
            @current-change="handleCurrentChange"
            :current-page.sync="activeIndex"
            :page-size="maxPagination"
            layout="total, prev, pager, next"
            :total="total">
        </el-pagination>
      </div>

      <br><br>


    </bird-container>
  </div>
</template>

<script>
import {
  mdbIcon,
  mdbJumbotron, mdbListGroup, mdbNavItem,
  mdbEdgeHeader,mdbBtn, mdbCard, mdbCardImage,
  mdbCardBody, mdbCardTitle, mdbCardText, mdbCarousel,

} from 'mdbvue';
import BirdContainer from "../../components/BirdContainer";

import {mapActions, mapMutations, mapState} from "vuex";
import Detail from "./components/Detail";
import DetailCategory from "./components/DetailCategory";

export default {
  name: "index",
  components: {
    DetailCategory,
    Detail, BirdContainer, mdbIcon, mdbJumbotron, mdbListGroup, mdbNavItem,
    mdbEdgeHeader, mdbCard, mdbCardImage,
    mdbCardBody, mdbCardTitle, mdbCardText, mdbBtn, mdbCarousel,
  },
  data(){
    return {
      activeIndex: undefined,
      article: {},
      comment:{},
      category:{}
    }
  },
  computed:{
    ...mapState({
      articles: (state) => state.article.articles,
      total: (state) => state.article.total,
      maxPagination: (state) => state.article.maxPagination,
    }),

    ...mapState({
      categorys: (state) => state.category.categorys,
    }),

    ...mapState({
      comments: (state) => state.comment.comments,
    }),

  },
  created() {
    this.allArticleAction({page: 1})
    this.allCommentAction({page: 1})
    this.allCategoryAction({page: 1})
  },


  methods:{
    ...mapActions('article',['allArticleAction']),
    ...mapActions('category',['allCategoryAction']),
    ...mapActions('comment',['allCommentAction']),


    // ...mapMutations('comment',['setComment','setIsAdd']),

    goTo(path){
      this.$router.push({path: path})
    },

    handleSizeChange(val) {
      console.log(`${val} items per page`);
    },
    async handleCurrentChange(page) {
      await this.allArticleAction({page: page})
    },

    goToCategoryListArticle(category){
      this.category = category
      this.$router.push({path: '/category/'+category.id})
    },

    goToArticle(article){
      this.article = article
      this.$router.push({path: '/article/'+article.id})
    }
  }
}
</script>

<style lang="scss" scoped>
#home {
  margin-top: 5em;
}

.category-page-background {
  width: 100%;
  height: 100%;
  opacity: 0.1;
  background: url('https://mdbootstrap.com/wp-content/uploads/2016/11/mdb-pro-min-1.jpg') center;
  background-size: cover;
}

.example-components-list {
  padding-top: 20px;
}

.example-components-list li {
  padding: 10px;
  background-color: white;
  border-bottom: 1px solid #f7f7f7;
  transition: .3s;
}

.example-components-list h6 {
  padding: 20px 10px 5px 10px;
  color: grey;
}

.example-components-list li:hover {
  background-color: #fafafa;
}

.example-components-list i {
  float: right;
  padding-top: 3px;
}

.nav-link.navbar-link h5 {
  color: #212529;
}

</style>