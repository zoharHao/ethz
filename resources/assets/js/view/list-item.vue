<template>
<div class="container">
	<mhead>
		<div class="color-tip handler left">
			<a @click="goback"><i class="fa fa-close fs18"></i></a>
		</div>
		历史下注
	</mhead>
	<div class="ctninner" v-loading="!isloaded">
		<div class="project-list" v-if="list.length > 0">
			<div class="project-list-item panel mb20" v-for="item in list" :key="item.id">
				<div class="panel-hd fs9">
					{{item.item_title}}
					<em class="tag" v-if="item.is_win == 1">获奖</em>
				</div>
				<div class="panel-bd fs9">
					<div class="mb10">
						<span class="color-gray">竞猜时间:</span>
						<span class="color-tip">{{item.item_rdate}}</span>
					</div>
					<div class="mb10">
						<span class="color-gray">竞猜价格:</span>
						<span class="color-tip">¥ {{item.item_price}}</span>
					</div>
					<div class="mb10">
						<span class="color-gray">竞猜额度:</span>
						<span class="color-tip">{{item.item_amount}} {{item.item_code}}</span>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>
</template>

<script>
import mhead from '../components/head.vue'
export default{
	mounted(){
		// console.log(this.$store.state.count)
	},
	components:{
		mhead
	},
	data(){
		return {
	      	list:'',
	      	isloaded:true
	      }
	},
    activated(){
    	let vm = this;
    	vm.getOrdersList()
    },
	methods: {
    	getOrdersList(){
    		var vm = this;
    		vm.isloaded = false;
    		vm.$http.get(vm.commonApi.listOrders).then(function(response){
    			vm.isloaded = true;
		 		if(response.body.code == 200) {
		 			vm.list = response.body.data.list
		 		}
        	})
    	},
		goback(){
			this.$router.go(-1)
		}
    }
}
</script>

<style>
</style>