<template>
  <div>
    <el-form :model="formCar">

      <el-form-item label="Name">
        <el-input v-model="formCar.name"> </el-input>
      </el-form-item>

      <div class="col-12">
        <Vueditor style="height: 200px; " ref="editor"> </Vueditor>
      </div>
    </el-form>

  </div>
</template>

<script>
import {mapActions, mapMutations, mapState} from "vuex";
import {required} from "vuelidate/lib/validators";

export default {
  name: "FormArticle",
  validations:{
    formCar:{
      name: {required},
    }
  },
  data: ()=> {
    return {
      formCar: {},
    }
  },
  mounted() {
    if(this.car != null){
      let editor = this.$refs['editor']
      editor.setContent(this.car.type) // template editor de text input
      this.formCar = this.car
    }
  },
  beforeDestroy() {
    let editor = this.$refs['editor']
    editor.setContent(null)
    this.setCar(null)
  },
  computed:{
    ...mapState({
      car: (state) => state.car.car,
      isAdd: (state) => state.car.isAdd,
    })
  },
  methods:{
    ...mapActions('car',['updateCarAction']),
    ...mapMutations('car',['setCar','setIsAdd']),
    async saveCar(){
      let editor = this.$refs['editor']
      if(editor.getContent() === ''){
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
        id: this.isAdd ? 0 : this.car.id,
        name: this.formCar.name,
        type: editor.getContent(),
      }
      await this.updateCarAction(param)
      this.$emit('dialog',false)
    }
  }
}
</script>

<style lang="scss" scoped>
.vueditor {
  height: 75vh;
  margin-top: 18px;
  width: 100%;
  margin-left: -23px;
  /*background-color: rgb(30,35,59);*/
  /*color: #FFFFFF;*/
}
</style>