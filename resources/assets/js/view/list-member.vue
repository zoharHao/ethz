<template>
<div class="container">
	<mhead>
		<div class="color-tip handler left">
			<a @click="goback"><i class="fa fa-angle-left fs18"></i></a>
		</div>
		项目成员
	</mhead>
	<div class="ctninner">
		<!--<div class="medal-row">
			<div v-if="winnerId != null">
				<div class="oner">
					<div class="img-box winner"><img :src="list[winnerId].avatar" /></div>
					<em class="medal"></em>
				</div>
				<div class="info"  style="color: #d4be00;">
					<div class="n blod"><span class="mr10">中奖者:</span><span>{{list[winnerId].name}}</span></div>
					<div class="p blod"><span class="mr10">买入价:</span><span>{{list[winnerId].price}}</span></div>
				</div>
			</div>
			
			<div v-else class="nowon color-gray">遗憾 ! 这期没有中奖者  >_<... </div>
		</div>-->
		<div class="panel">
			<div class="panel-bd">
				<div class="memberList" v-loading="!isloaded" v-pfresh>
					<ul  v-if="list.length > 0">
						<li v-for="(item, index) in list">
							<div class="avatar img-box"><img :src="item.avatar" /></div>
							<div class="info">
								<div class="r">
									<span class="fs14">{{item.name}}</span>
									<span class="color-light fs9 pull-right" v-if="item.betting == 'rise'">
										买入： <font class="color-rise"><i class="fa fa-caret-up"></i> 涨</font>
									</span>
									<span class="color-light fs9 pull-right" v-else-if="item.betting == 'flat'">
										买入：<font><i class="fa fa-minus"></i> 平</font>
									</span>
									<span class="color-light fs9 pull-right" v-else-if="item.betting == 'fall'">
										买入： <font class="color-fall"><i class="fa fa-caret-down"></i> 跌</font>
									</span>
								</div>
								<div class="r fs9">
									<span class="color-light">{{item.createdAt}}</span>
									<span class="color-light pull-right">投注:{{item.amount}}{{item.code}}</span>
								</div>
							</div>
						</li>
					</ul>
					<div @click="getMemberList" class="handle text-center pt20 pb20" :class="handleStr=='加载更多'?'color-tip':'color-gray'" >{{handleStr}}</div>
				</div>
			</div>
		</div>
	</div>
</div>
</template>

<script>
import mhead from '../components/head.vue'
import mnav from '../components/unav.vue'
export default{
	mounted(){
//		console.log(this.$store.state.count)
	},
	components:{
		mhead,
		mnav
	},
	data(){
		return {
			pid:'',
	      	list:[],
//	      	winnerId:null,
	      	isloaded:true,
	      	last:null,
	      	handleStr:'加载更多'
	      }
	},
    activated(){
    	var vm = this;
    	if(vm.pid != vm.$route.query.pid){
    		vm.dataClear();
    		vm.getMemberList();
    	}
    },
	methods:{
		getMemberList(){
    		var vm = this
    		if(vm.handleStr != '没有更多数据了') {
    			vm.pid = vm.$route.query.pid;
    			vm.isloaded = false;
	    		vm.$http.get( vm.commonApi.listAttendance, {params:{guess_id:vm.pid, sinceId:vm.last}}
	    			).then(function(response){
	    			let res = response.body;
	    			vm.isloaded = true;
			 		if(res.code == 200) {
			 			vm.list = vm.list.concat(res.data.list);
			 			vm.last = res.data.last;
			 			vm.handleStr = '加载更多';
			 		}else if(res.code == 403){
			 			vm.handleStr = '没有更多数据了';
			 		}
			 		
//			 		for(let i = 0; i < res.data.list.length; i++) {
//			 			if(res.data.list[i].is_win == 1) {
//			 				vm.winnerId = i;
//			 			}
//			 		}
	        	}).catch(err => {
	        		vm.isloaded = true;
	        		console.log(err)
	        	});
        	}
    	},
    	dataClear(){
    		var vm = this;
	    	vm.list = new Array();
	    	vm.last = null;
	    	vm.handleStr = '加载更多';
    	},
		goback(){
			this.$router.go(-1)
		}
	}
}
</script>

<style>
</style>