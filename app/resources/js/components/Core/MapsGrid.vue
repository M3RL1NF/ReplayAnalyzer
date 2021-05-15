<template>
	<b-row>
		<b-col cols="3" class="mt-4" v-for="map in maps" :key="map">
			<b-img thumbnail fluid :src="getMapImage(map.name)" @click="getMap(map.id)"></b-img>
		</b-col>
	</b-row>
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
						if (data.data.maps) {
							this.maps = data.data.maps;
						}
					})
					.catch(error => {
						console.error(error);
					});
			},

			getMapImage(mapName) {
				return 'img/maps/' + mapName + '.jpg';
			},

            getMap(mapId) {
				axios
					.post('/api/core/getMaps', {
						mapId: mapId
					})
					.then(data => {
						if (data.data) {
							this.maps = data.data.data;
						}
					})
					.catch(error => {
						console.error(error);
					});
			}
		}
	}
</script>


