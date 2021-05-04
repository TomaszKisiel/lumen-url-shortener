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
            const {
                duosexagesimal_id: duosexagesimalId,
                shorten_url: shortenURL,
                original_url: originalURL,
                visits,
                created_at: createdAt,
                hidden
            } = res[ "link" ]

            const previous = document.querySelector( '.new-url' )
            if ( previous ) {
                previous.classList.remove("new-url")
            }

            if ( hidden ) {
                Swal.fire( {
                    title: 'Successful!',
                    html: '<a href="' + shortenURL + '">' + shortenURL + '</a><input class="to-clipboard visually-hidden-focusable" type="text" value="' + shortenURL + '"/>',
                    icon: 'success',
                    allowOutsideClick: false,
                    showCancelButton: true,
                    showCloseButton: true,
                    confirmButtonText: 'Copy'
                } ).then( e => {
                    if ( e.isConfirmed ) {
                        const shorten = document.querySelector( '.to-clipboard' )

                        shorten.focus()
                        shorten.select()

                        document.execCommand( 'copy' )
                    }
                } )
            } else {

                const template = document.querySelector( '#templateEntry' )
                template.content.querySelector( '.entry' ).classList.add( "new-url" )
                template.content.querySelector( '.hostname' ).innerHTML = ( new URL( originalURL ) ).hostname
                template.content.querySelector( '.duosexagesimal-id' ).innerHTML = duosexagesimalId
                template.content.querySelector( '.created-at' ).innerHTML = createdAt

                template.content.querySelector( '.original-url' ).innerHTML = originalURL
                template.content.querySelector( '.original-url' ).href = originalURL

                template.content.querySelector( '.shorten-url' ).innerHTML = shortenURL
                template.content.querySelector( '.shorten-url' ).href = shortenURL

                template.content.querySelector( '.visits-counter' ).innerHTML = visits


                const entries = document.querySelector( '#entries' )
                if ( entries ) {
                    entries.prepend( template.content.cloneNode( true ) )
                }

                if ( entries && entries.children.length > 10 ) {
                    entries.removeChild( entries.lastElementChild )
                }

                const noEntries = document.querySelector( '#noEntries' )
                if ( noEntries ) {
                    noEntries.remove();
                }
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

