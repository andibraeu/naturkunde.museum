<template>
  <h1>Naturkundemuseen in Deutschland</h1>
  <div>
    <table>
      <tr>
        <th>Bild/Logo</th>
        <th>Name</th>
        <th>Adresse</th>
        <th>Kontakt</th>
      </tr>
      <tr v-for="museum in museums" :key="museum">
        <td v-if="museum.logo"><img :src="museum.logo" class="museum-image"></td>
        <td v-else-if="museum.image"><img :src="museum.image" class="museum-image"></td>
        <td v-else></td>
        <td v-if="museum.name">
          <a v-if="museum.website" :href="museum.website" target="_blank">
            {{museum.name}}
          </a>
          <span v-else>{{ museum.name }}</span>
        </td>
        <td v-else>no name</td>
        <td v-if="museum.address">{{ museum.address }}</td>
        <td v-else></td>
        <td>
          <a v-if="museum.phone" :href="'phone:' + museum.phone" target="_blank">
            <fa-layers class="fa-lg">
              <fa :icon="['fas', 'square']"></fa>
              <fa :icon="['fas', 'phone']" class="fa-inverse" transform="shrink-6"></fa>
            </fa-layers>
          </a>
          <a v-if="museum.facebook" :href="'https://facebook.com/' + museum.facebook" target="_blank">
            <fa-layers class="fa-lg">
              <fa :icon="['fas', 'square']"></fa>
              <fa :icon="['fab', 'facebook-f']" class="fa-inverse" transform="shrink-6"></fa>
            </fa-layers>
          </a>
          <a v-if="museum.twitter" :href="'https://twitter.com/' + museum.twitter" target="_blank">
            <fa-layers class="fa-lg">
              <fa :icon="['fas', 'square']"></fa>
              <fa :icon="['fab', 'twitter']" class="fa-inverse" transform="shrink-6"></fa>
            </fa-layers>
          </a>
          <a v-if="museum.email" :href="'mailto:' + museum.email" target="_blank">
            <fa-layers class="fa-lg">
              <fa :icon="['fas', 'square']"></fa>
              <fa :icon="['fas', 'paper-plane']" class="fa-inverse" transform="shrink-6"></fa>
            </fa-layers>
          </a>
        </td>
      </tr>

    </table>

  </div>
</template>

<script>
import { ref } from "vue";
import axios from 'axios';

export default {
  name: 'Museums',
  props: {
  },
  setup() {
      const isLoading = ref(false);
      const museums = ref([]);

      const getMuseums = async () => {
        try {
          isLoading.value = true;

          const { data } = await axios.get('https://naturkunde.museum/data/data.json');
          museums.value = data.results.bindings.reduce(function(accum, currentVal) {
            accum[currentVal.item.value] = Object.keys(currentVal).reduce(function(value, key) {
              value[key] = currentVal[key].value;
              return value;
            }, {});
            return accum;
          }, {});

        } catch (err) {
          // handle error here
        } finally {
          isLoading.value = false;
       }
      };

      getMuseums();

      return {
        museums,
        isLoading,
      };
    },
}
</script>
