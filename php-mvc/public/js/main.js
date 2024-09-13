const flashElement = document.querySelector("#msg-flash")

if (flashElement != null) {
  const flashTimeout = setTimeout(removeFlash, 3000)
}

function removeFlash() {
  flashElement.remove()
}