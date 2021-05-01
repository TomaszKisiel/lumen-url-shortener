import Swal from 'sweetalert2'

const form = document.querySelector( '#form' )
if ( form ) {
    form.addEventListener( 'submit', function ( e ) {
        e.preventDefault()

        const url = document.querySelector( '[name=url]' )?.value ?? ''
        const hidden = document.querySelector( '[name=hidden]' )?.checked

        fetch( '/', {
            'method': 'POST',
            'headers': {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            'body': JSON.stringify( {
                url,
                hidden
            } )
        } ).then( res => {
            if ( !res.ok ) {
                throw res
            }

            return res.json()
        } ).then( res => {
            const { shorten, hash, url, visits, created_at: createdAt } = res[ "url" ]

            // Swal.fire( {
            //     title: 'Successful!',
            //     html: '<a href="' + shorten + '">' + shorten + '</a><input id="shorten" class="visually-hidden-focusable" type="text" value="' + shorten + '"/>',
            //     icon: 'success',
            //     allowOutsideClick: false,
            //     showCancelButton: true,
            //     showCloseButton: true,
            //     confirmButtonText: 'Copy'
            // } ).then( e => {
            //     if ( e.isConfirmed ) {
            //         const shorten = document.querySelector( '#shorten' )
            //
            //         shorten.focus()
            //         shorten.select()
            //
            //         document.execCommand( 'copy' )
            //     }
            // } )

            const template = document.querySelector( '#templateUrl' )
            template.content.querySelector( 'article' ).classList.add("new-url")
            // template.content.querySelector( 'article' ).classList.add("bg-success", "text-white")

            template.content.querySelector( '#hostUrl' ).innerHTML = ( new URL(url ) ).hostname

            template.content.querySelector( '#hashUrl' ).innerHTML = hash
            // template.content.querySelector( '#hashUrl' ).classList.remove("bg-success")
            // template.content.querySelector( '#hashUrl' ).classList.add("bg-primary")

            template.content.querySelector( '#createdAt' ).innerHTML = createdAt
            // template.content.querySelector( '#createdAt' ).classList.remove("btn-outline-secondary")
            // template.content.querySelector( '#createdAt' ).classList.add("btn-outline-light")

            template.content.querySelector( '#fullUrl' ).innerHTML = url
            template.content.querySelector( '#fullUrl' ).href = url
            // template.content.querySelector( '#fullUrl' ).classList.add("text-dark")

            template.content.querySelector( '#shortenUrl' ).innerHTML = shorten
            template.content.querySelector( '#shortenUrl' ).href = shorten
            // template.content.querySelector( '#shortenUrl' ).classList.add("text-dark")

            template.content.querySelector( '#visitsText' ).innerHTML = visits
            // template.content.querySelector( '#visitsText' ).classList.remove("bg-primary")
            // template.content.querySelector( '#visitsText' ).classList.add("bg-dark")

            // template.content.querySelector( '#visitsButton' ).classList.remove("btn-outline-primary")
            // template.content.querySelector( '#visitsButton' ).classList.add("btn-outline-light")

            const urls = document.querySelector('#urls')
            if ( urls ) {
                urls.prepend( template.content.cloneNode(true) )
                urls.removeChild( urls.lastElementChild )
            }

            document.querySelector( '[name=url]' ).value = ""
        } ).catch( e => {
            console.log( e )

            Swal.fire( {
                title: 'Something went wrong!',
                text: 'Please make sure the link is correct and try again.',
                icon: 'error',
            } )
        } )
    } )
}

