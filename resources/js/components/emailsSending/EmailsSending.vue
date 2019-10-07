<template>
	<div>
		<div class="btn-group mb-4" role="group">
			<button type="button" class="btn" :class="{ 'btn-primary': singleMode }" @click="changeMod">Single mode</button>
			<button type="button" class="btn" :class="{ 'btn-primary': !singleMode }" @click="changeMod">Mass mode</button>
		</div>
		<SingleEmailsSending v-if="singleMode"></SingleEmailsSending>
		<MassEmailsSending v-if="!singleMode"></MassEmailsSending>
	</div>
</template>

<script>
	import SingleEmailsSending from './SingleEmailsSending'
	import MassEmailsSending from './MassEmailsSending'
	export default {
		data: function() {
			return {
				singleMode: true
			}
		},
		components:{
			SingleEmailsSending,
			MassEmailsSending
		},
		methods:{
			changeMod(){
				return this.singleMode = !this.singleMode
			},
			showMode(){
				console.log('singleMode', this.singleMode)
			}
		},
		mounted() {
			this.showMode()
		}
	}
</script>