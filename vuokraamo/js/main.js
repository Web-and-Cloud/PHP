// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })

  let riviMaara = 1
  const lisaaRiviBtn = document.querySelector("#lisaaRivi")

  if (lisaaRiviBtn != null) {
    lisaaRiviBtn.addEventListener("click", () => {
      const rivi = document.querySelector("#rivi-1")

      const uusiRivi = rivi.cloneNode(true)
      uusiRivi.id = "rivi-" + ++riviMaara
      rivi.after(uusiRivi)

      const tdElementit = uusiRivi.getElementsByTagName("td")
      const viimeinenTD = tdElementit[tdElementit.length - 1]

      const painike = viimeinenTD.getElementsByTagName("button")
      painike[0].classList.remove("piiloon")

      painike[0].addEventListener("click", (e) => {
        const riviTR = e.target.parentNode.parentNode
        riviTR.remove()
        riviMaara--
      })

    })
  }

  async function haeAsiakastiedot(hakusana) {
    const response = await fetch('asiakashaku.php?hakusana=' + hakusana);
    const data = await response.text()

    return data
  }

  const asiakasHakuBtn = document.querySelector('#asiakashaku')

  if(asiakasHakuBtn != null){
    asiakasHakuBtn.addEventListener('click',()=>{
      let hakusana = document.querySelector('#hakusana')

      haeAsiakastiedot(hakusana.value)
       .then((data) =>{
            const asiakastiedot = document.querySelector("asiakastiedot")
            asiakastiedot.innerHTML = data
        })
    })
  }

})()