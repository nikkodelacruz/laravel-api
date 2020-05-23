<template>
	<div>
		<h1>All Articles</h1>
		<div class="jumbotron">
			<form @submit.prevent="addArticle()">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Title" v-model="article.title">
				</div>
				<div class="form-group">
					<textarea class="form-control" cols="30" rows="10" v-model="article.body" placeholder="Body"></textarea>
				</div>
				<input type="submit" class="btn btn-info" :value="action">
			</form>
		</div>
		<div class="card-columns">
			<div class="card" v-for="article in articles" :key="article.id">
			    <img class="card-img-top" :src="randomImage()" alt="Card image cap">
			    <div class="card-body">
			      	<h5 class="card-title">{{article.title}}</h5>
			      	<p class="card-text">{{article.body}}</p>
			      	<a href="#" class="text-danger" @click.prevent="deleteArticle(article.id)">Delete</a>
			      	<a href="#" class="text-info" @click.prevent="editArticle(article)">Edit</a>
			    </div>
			</div>
		</div>

		<!-- Pagination -->
		<nav aria-label="Page navigation example">
		  <ul class="pagination">
		    <li :class="[{'page-item disabled': !pagination.prev_page_url}]"><a class="page-link" href="#" @click.prevent="getAllArticles(pagination.prev_page_url)">Previous</a></li>
		    <li class="page-item disabled"><a class="page-link" href="#">Page {{pagination.current_page}} of {{pagination.last_page}}</a></li>
		    <li :class="[{'page-item disabled': !pagination.next_page_url}]"><a class="page-link" href="#" @click.prevent="getAllArticles(pagination.next_page_url)">Next</a></li>
		  </ul>
		</nav>

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
				article_id: '',
				pagination: {},
				edit: false,
				action: 'Add',
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
 			getAllArticles(page_url) {
 				let vm = this;
 				page_url = page_url || '/api/articles'
				axios
					.get(page_url)
					.then(res => { 
						// console.log(res.data)
						this.articles = res.data.data;
						vm.makePagination(res.data.meta, res.data.links);
					})
					.catch(err => console.log(err));
			},
			addArticle() {
				if (!this.edit) {
					// Add
					axios
						.post('/api/article', {
							title: this.article.title,
							body: this.article.body
							// data: JSON.stringify(this.article),
							// headers: {
								// 'Content-Type': 'application/json'
							// }
						})
						.then(res => { 
							// console.log(res)
							this.article.title = '';
							this.article.body = '';
							alert('Added');
							this.getAllArticles();

						})
						.catch(err => console.log(err));
				} else{
					// Edit
					axios
						.put('/api/article', {
							article_id: this.article.id,
							title: this.article.title,
							body: this.article.body
						})
						.then(res => { 
							// console.log(res)
							this.article.title = '';
							this.article.body = '';
							this.getAllArticles();
							this.edit = false;
							alert('Updated');
						})
						.catch(err => console.log(err));
				}
			},
			editArticle(article) {
				this.edit = true;
				this.article.id = article.id;
				this.article.title = article.title;
				this.article.body = article.body;
			},
			deleteArticle(id) {
				if (confirm('Are you sure about that?')) {
					axios
						.delete(`/api/article/${id}`)
						.then(res => {
							// console.log(res)
							this.getAllArticles();
						})
						.catch(err => console.log(err))
				}
			},
			makePagination(meta, links) {
				let pagination = {
					current_page: meta.current_page,
					last_page: meta.last_page,
					next_page_url: links.next,
					prev_page_url: links.prev,
				}
				this.pagination = pagination;
			},
			randomImage() {
				return this.images[Math.floor(Math.random()*this.images.length)];
			}
		},
		created() {
			this.getAllArticles();
		},
		watch: {
			edit() {
				if (this.edit) {
					this.action = "Update";
				} else {
					this.action = "Add";
				}
			}
		},
		mounted() {
			console.log('mounted');
		}

	}
</script>
<style>
</style>