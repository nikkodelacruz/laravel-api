<template>
	<div class="mt-4">
		<h1>Lastest Articles</h1>
		<div class="card-deck mt-3">
			<div class="card mx-2" v-for="article in articles" :key="article.id">
				<img class="card-img-top" :src="randomImage()" alt="Card image cap">
				<div class="card-body">
				<h5 class="card-title">{{article.title}}</h5>
				<p class="card-text">{{article.body}}</p>
				<p class="card-text"><small class="text-muted">{{article.created_at}}</small></p>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		data() {
			return {
				articles: [],
				article: {
					id: '',
					title: '',
					body: '',
				},
				images: [
					'https://picsum.photos/id/1011/5472/3648',
			      	'https://picsum.photos/id/1000/5626/3635',
			      	'https://picsum.photos/id/1006/3000/2000',
			      	'https://picsum.photos/id/1016/3844/2563',
			      	'https://picsum.photos/id/1018/3914/2935'
			    ],
			    selectedImage: ''
			}
		},
		methods: {
			getLatestArticles() {
				axios.get('/api/articles/latest')
					.then(res => { 
						console.log(res)
						this.articles = res.data;
					})
					.catch(err => console.log(err));
			},
			randomImage() {
				return this.images[Math.floor(Math.random()*this.images.length)];
			}
		},
		created() {
			this.getLatestArticles();
		},
		mounted() {
			console.log('mounted');
		}
	}
</script>
<style>
</style>