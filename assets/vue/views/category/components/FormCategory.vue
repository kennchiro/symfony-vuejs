<template>
<div>

  <el-form :model="formCat">
    <el-form-item label="Name category">
      <el-input v-model="formCat.nomcat"> </el-input>
    </el-form-item>
  </el-form>

</div>
</template>

<script>

import {mapActions, mapMutations, mapState} from "vuex";
import {required} from "vuelidate/lib/validators";

export default {
name: "FormCategory",

  validations:{
    formCat:{
      nomcat: {required},
    }
  },

  data: ()=> {
    return {
      formCat: {},
    }
  },

  mounted() {
    if(this.category != null){
      this.formCat = this.category
    }
  },

  beforeDestroy() {
    this.setCategory(null)
  },

  computed:{
    ...mapState({
      category: (state) => state.category.category,
      isAdd: (state) => state.category.isAdd,
    })
  },

  methods:{
    ...mapActions('category',['updateCategoryAction']),
    ...mapMutations('category',['setCategory','setIsAdd']),
    async saveCategory(){
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
        id: this.isAdd ? 0 : this.category.id,
        nomcat: this.formCat.nomcat,
      }
      await this.updateCategoryAction(param)
      this.$emit('dialog',false)
    }
  }


}
</script>

<style scoped>

</style>