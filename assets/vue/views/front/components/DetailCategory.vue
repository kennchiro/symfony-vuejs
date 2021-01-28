<template>
<div>

  <h3 style="margin: 0 auto;">
    {{ category.nomcat }}
  </h3>

  <bird-container>

    <div class="row">
      <template v-for="catego in category.article">
        <mdb-card style="margin-left: 8px; margin-bottom: 4px;">
          <mdb-card-body>
            <mdb-card-title> {{catego.title}} </mdb-card-title>
            <mdb-card-text>   {{ catego.description }} </mdb-card-text>
            <el-button @click="goTo" type="primary" icon="el-icon-arrow-right" size="small"> show comments </el-button>
          </mdb-card-body>
        </mdb-card>
      </template>

<!--       <br> <br>-->
<!--      <div>-->
<!--        <template v-for="cate in article.comment">-->
<!--          <div class="col-md-4">-->
<!--            {{ cate.persocom }} | {{ cate.datecom }}-->
<!--          </div>-->

<!--          <div class="col">-->
<!--            {{ cate.textcom }}-->
<!--          </div>-->
<!--        </template>-->
<!--      </div>-->



    </div>

  </bird-container>

</div>
</template>

<script>
import {mdbBtn, mdbIcon,
  BirdContainer,mdbCard,mdbCardBody, mdbCardTitle,
  mdbCardText,
} from "mdbvue";

export default {
name: "DetailCategory",
components:{
  BirdContainer,mdbCardBody,
  mdbIcon,mdbCard,
  mdbBtn, mdbCardTitle,
  mdbCardText,
},
  //important
  props:{
    category: {type: Object},
    // article: {type: Object}
  },

  methods:{
    goTo(){
      this.$router.push({path: '/'})
    }
  },

}
</script>

<style scoped>

</style>