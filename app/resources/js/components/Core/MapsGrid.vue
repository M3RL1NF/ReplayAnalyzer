<template>
	<!-- overview of all maps -->
	<div v-if="!map">
		<b-row>
			<b-col cols="3" class="mt-4" v-for="(map, maps_index) in maps" :key="maps_index">
				<b-img thumbnail fluid :src="getMapImage(map.name)" @click="getMap(map)"></b-img>
			</b-col>
		</b-row>
	</div>

	<!-- detailed information about selected map -->
	<div v-else>
		<b-row>
			<b-col>
				<h2>{{ map_name }}</h2>
			</b-col>
		</b-row>

		<b-row class="mt-4"> 
			<b-col cols="3">
				<b-img thumbnail fluid :src="getMapImage(map_name)"></b-img>
			</b-col>

			<b-col cols="3">
				<b-form-select v-model="selected_patch">
					<template #first>
						<b-form-select-option :value="null" disabled>Patch</b-form-select-option>
					</template>
					<b-form-select-option v-for="(patch, map_index) in map" :key="map_index" :value="patch">{{ map_index }}</b-form-select-option>
				</b-form-select>

				<b-form-select class="mt-4" v-model="selected_game_mode">
					<template #first>
						<b-form-select-option :value="null" disabled>Game Mode</b-form-select-option>
					</template>
					<b-form-select-option v-for="(game_mode, game_mode_index) in selected_patch" :key="game_mode_index" :value="game_mode[0]">{{ game_mode_index }}</b-form-select-option>
				</b-form-select>
			</b-col>

			<b-col cols="3">
				<p>Battles evaluated:</p> 
				<p>Avg Duration:</p>
				<p>Draws:</p>
				<p>Victorys Spawn 1:</p>
				<p>Victorys Spawn 2:</p>
			</b-col>

			<b-col v-if="selected_patch && selected_game_mode" cols="3">
				<p>{{ selected_game_mode.games }}</p> 
				<p>{{ selected_game_mode.duration }}</p> 
				<p>{{ selected_game_mode.draws }} %</p> 
				<p>{{ selected_game_mode.winsSpawn1 }} %</p> 
				<p>{{ selected_game_mode.winsSpawn2 }} %</p> 
			</b-col>

			<b-col v-else cols="3">
				<!-- -->
				<p>21.398</p> 
				<p>06:46</p> 
				<p>1,2 %</p> 
				<p>51,3 %</p> 
				<p>47,5 %</p> 
			</b-col>
		</b-row>
	</div>
</template>

<script>
    export default {
		data: function () {
			return {
				maps: null,
				map: null,
				map_name: null,
				selected_patch: null,
				selected_game_mode: null
			}
		},

        created() {
			this.getMaps();
		},

		methods: {
			getMaps() {
				axios
					.post(
                        '/api/core/get-maps'
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

            getMap(map) {
				this.map_name = map.name;

				axios
					.post('/api/core/get-map', {
						mapId: map.id
					})
					.then(data => {
						if (data.data) {
							this.map = data.data;
						}
					})
					.catch(error => {
						console.error(error);
					});
			}
		}
	}
</script>


