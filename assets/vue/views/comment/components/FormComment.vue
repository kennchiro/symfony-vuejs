<template>
  <div>
    <el-form :model="formComment">

      <el-form-item label="Person">
        <el-input v-model="formComment.persocom"> </el-input>
      </el-form-item>

<!--      <el-form-item label="Date">-->
<!--        <el-input v-model="formComment.datecom"> </el-input>-->
<!--      </el-form-item>-->

      <el-form-item  label="Article">
        <el-select v-model="selectedArticle" placeholder="Select">
          <el-option
              v-for="item in articles"
              :key="item.id"
              :label="item.title"
              :value="item.id">
          </el-option>
        </el-select>
      </el-form-item>

      <div class="col-12">
        <Vueditor ref="editor"> </Vueditor>
      </div>

    </el-form>
  </div>
</template>

<script>
import {mapActions, mapMutations, mapState} from "vuex";
import {required} from "vuelidate/lib/validators";

export default {
  name: "FormComment",
  validations: {
    formComment:{
      persocom:{required},
      // datecom:{required}
    }
  },

  data: ()=> {
    return {
      formComment: {},
      selectedArticle: 0,
    }
  },

  mounted() {
    if(this.comment != null){
      let editor = this.$refs['editor']
      editor.setContent(this.comment.textcom)
      this.formComment = this.comment
      this.selectedArticle = this.comment.article.id
    }else {
      this.selectedArticle = this.articles[0].id
    }
  },

  beforeDestroy() {
    let editor = this.$refs['editor']
    editor.setContent(null)
    this.setComment(null)
  },

  computed:{
    ...mapState({
      articles: (state) => state.comment.articles,
      comment: (state) => state.comment.comment,
      isAdd: (state) => state.comment.isAdd,
    })
  },

  methods:{
    ...mapActions('comment',['updateCommentAction']),
    ...mapMutations('comment',['setComment','setIsAdd']),

    async saveComment(){
      const article = this.articles.find(item => item.id == this.selectedArticle)
      let editor = this.$refs['editor']
      if(editor.getContent() == ''){
        this.$notify({
          title: 'Warning',
          message: 'Mandatory description field',
          type: 'warning'
        });
        return false
      }
      this.$v.$touch()
      if (this.$v.$invalid) {
        this.$notify({
          title: 'Warning',
          message: 'Mandatory field',
          type: 'warning'
        });
        return false
      }

      const param  = {
        id: this.isAdd ? 0 : this.comment.id,
        persocom: this.formComment.persocom,
        article: article,
        textcom: editor.getContent(),
        // datecom: this.formComment.datecom
      }
      await this.updateCommentAction(param)
      this.$emit('dialog',false)
    }
  } //

}
</script>


<style lang="scss" scoped>
.vueditor {
  height: 25vh;
  margin-top: 18px;
  width: 100%;
  margin-left: -23px;
  /*background-color: rgb(30,35,59);*/
  /*color: #FFFFFF;*/
}
</style>