export default function ({ $axios, redirect }) {
  $axios.onResponse(response => {
    return response.data.result
  })
}
