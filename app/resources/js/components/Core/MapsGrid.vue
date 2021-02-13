<template>

</template>

<script>
    export default {
		data: function () {
			return {
				maps: null,
                map: null
			}
		},

        watch: {
			map: {
				handler: function () {
					if (map) {
                        this.getMap();
                    }
				}
			}
		},

        created() {
			this.getMaps();
		},

		methods: {
			getMaps() {
				axios
					.post(
                        '/api/core/getMaps'
                    )
					.then(data => {
                        console.log('here');
						if (data.data) {
							this.maps = data.data.data;
						}
					})
					.catch(error => {
						console.error(error);
					});
			},

            /* getMap() {
				axios
					.post(
                        '/api/core/getMaps'
                    )
					.then(data => {
						if (data.data) {
							this.maps = data.data.data;
						}
					})
					.catch(error => {
						console.error(error);
					});
			} */
		}
	}
</script>


