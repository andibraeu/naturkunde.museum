<template>
  <h1>Naturkundemuseen in Deutschland</h1>
  <DataTable :value="museums" stripedRows responsiveLayout="scroll">
    <Column header="Bild/Logo">
      <template #body="slotProps">
        <img v-if="slotProps.data.logo" :src="slotProps.data.logo" alt="Logo des Museums" class="museum-image" />
        <img v-else-if="slotProps.data.thumb" :src="slotProps.data.thumb" alt="Ein Bild des Museums" class="museum-image" />
        <img v-else-if="slotProps.data.image" :src="slotProps.data.image" alt="Ein Bild des Museums" class="museum-image" />
      </template>
    </Column>
    <Column header="Name" field="name" :sortable="true">
      <template #body="slotProps1">
        <a v-if="slotProps1.data.website" :href="slotProps1.data.website" target="_blank">
          {{slotProps1.data.name}}
        </a>
        <span v-else>{{ slotProps1.data.name }}</span>
      </template>
    </Column>
    <Column field="address" header="Adresse"></Column>
    <Column header="Kontakt">
      <template #body="slotProps">
        <a v-if="slotProps.data.phone" :href="'phone:' + slotProps.data.phone" target="_blank" class="contact-items">
          <Button icon="pi pi-phone" class="p-button-raised p-mr-2 p-mb-2 contacts" />
        </a>
        <a v-if="slotProps.data.facebook" :href="'https://facebook.com/' + slotProps.data.facebook" target="_blank" class="contact-items">
          <Button icon="pi pi-facebook" class="p-button-raised p-mr-2 p-mb-2 contacts" />
        </a>
        <a v-if="slotProps.data.twitter" :href="'https://twitter.com/' + slotProps.data.twitter" target="_blank" class="contact-items">
          <Button icon="pi pi-twitter" class="p-button-raised p-mr-2 p-mb-2 contacts" />
        </a>
        <a v-if="slotProps.data.email" :href="'mailto:' + slotProps.data.email" target="_blank" class="contact-items">
          <Button icon="pi pi-envelope" class="p-button-raised p-mr-2 p-mb-2 contacts" />
        </a>
      </template>
    </Column>
  </DataTable>
  <div>
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
          var museumsObject = data.results.bindings.reduce(function(accum, currentVal) {
            accum[currentVal.item.value] = Object.keys(currentVal).reduce(function(value, key) {
              value[key] = currentVal[key].value;
              return value;
            }, {});
            return accum;
          }, {});
          for (var museum in museumsObject) {
            museums.value.push(museumsObject[museum])
          }

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
