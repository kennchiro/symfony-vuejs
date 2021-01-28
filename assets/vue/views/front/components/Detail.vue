<template>

  <mdb-card class="my-1">
    <mdb-card-body>
      <mdb-card-title>
        <h6 class="card-title h1-responsive pt-1 mb-5 font-bold">
          {{ article.title }}
        </h6>
        <p style="font-size: 12px;margin-bottom: 1em;color: #000">
          <strong> Author : " {{article.author.name}} " </strong>
          <strong>  {{article.author.id}}  </strong>
        </p>
      </mdb-card-title>
      <p v-html="article.description"></p>

      <div id="commentaires" style="border-bottom: 1px dotted black;">
        <h4>
          {{ article.comment.length }} : Comments
        </h4>
      </div>

      <br>
      <!--   all data commentes     -->

         <div v-for="com in article.comment">
         <div class="row">
           <div class="col-md-6">
             {{ com.persocom }} :  <small> {{ com.datecom }} </small>
           </div>
           <div class="col">
             <small> {{ com.textcom }} </small>
           </div>
         </div>
       </div>



      <br> <br>

      <template>
        <!-- Material form login -->
        <!-- Material form login -->

        <div class="row">
          <mdb-btn @click="add" color="default"> Add Comment </mdb-btn>
        </div>

        <el-dialog :title="title" :visible.sync="dialogFormVisible">

          <form-comment v-if="dialogFormVisible" ref="comment" @dialog="dialog($event)"/>

          <span slot="footer" class="dialog-footer">
                    <el-button @click="cancel">Cancel</el-button>
                    <el-button type="primary" @click="validate">Validate</el-button>
              </span>
        </el-dialog>
      </template>
    </mdb-card-body>
  </mdb-card>


</template>

<script>
import {
  mdbCard, mdbBtn, mdbCardBody,
  mdbCardTitle, mdbInput, mdbTextarea,
  mdbIcon, mdbModal, mdbModalHeader, mdbModalTitle,
  mdbModalBody, mdbModalFooter,
} from 'mdbvue';

import {mapState, mapActions, mapMutations} from 'vuex';
import FormComment from "../../comment/components/FormComment";
import {required} from "vuelidate/lib/validators";

export default {
  name: "Detail",
  props:{
    article: {type: Object},
  },

  validations:{
    formCo:{
      persocom:{required}
    },

  },

  data: ()=> {
    return {
      dialogFormVisible: false,
      title: null,

      formCo:{},
      selectedArticles: 0,
    }
  },

  created() {
    this.allCommentAction({page: 1})
  },

  mounted() {
  },

  components: {
    mdbCard, mdbBtn, mdbCardBody,
    mdbCardTitle, mdbInput, mdbTextarea, mdbIcon,
    mdbModal, mdbModalHeader, mdbModalTitle, mdbModalBody,
    mdbModalFooter, FormComment
  },

  computed:{
    // thread
    ...mapState({
      comments: (state) => state.comment.comments, // 'article' ici c'est la module->store
      total: (state) => state.comment.total,
      maxPagination: (state) => state.comment.maxPagination,
    }),

  },

  methods:{
    ...mapActions('comment',['allCommentAction','removeCommentAction']),
    ...mapMutations('comment',['setComment','setIsAdd']),

    handleSizeChange(val) {
      console.log(`${val} items per page`);
    },
    async handleCurrentChange(page) {
      await this.allArticleAction({page: page})
    },

    add(){
      this.setComment(null)
      this.setIsAdd(true)
      this.title = 'Add Comment'
      this.dialogFormVisible = true
    },

    validate(){
      this.$refs.comment.saveComment()
    },
    dialog(value){
      this.dialogFormVisible = value
    },
    cancel(){
      this.setComment(null)
      this.dialogFormVisible = false
    },

  },//

  goTo(){
    this.$router.push({path: '/'})
  }

}
</script>

<style scoped>

</style>