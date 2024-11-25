(function() {
    tinymce.PluginManager.add('shortcodes_button', function( editor, url ) {
        editor.addButton( 'instagram', {
            title: 'Instagram',
            icon: 'icon is-dashicon dashicons-instagram',
            onPostRender: function () {
                jQuery( '.is-dashicon' ).css( 'font-family', 'dashicons' );
            },
            onclick: function() {
                editor.windowManager.open( {
                    title: 'Instagram URL',
                    body: [{
                        type: 'textbox',
                        name: 'instagram',
                        label: 'URL'
                    }],
                    onsubmit: function( e ) {
                        editor.insertContent( '<a class="c-button c-button--social c-button--primary" href="' + e.data.instagram + '"><i class=" icon-instagram"></i><span>instagram</span></a>');
                    }
                });
            }
        });
        editor.addButton( 'facebook', {
            title: 'Facebook',
            icon: 'icon is-dashicon dashicons-facebook-alt',
            onPostRender: function () {
                jQuery( '.is-dashicon' ).css( 'font-family', 'dashicons' );
            },
            onclick: function() {
                editor.windowManager.open( {
                    title: 'Facebook URL',
                    body: [{
                        type: 'textbox',
                        name: 'facebook',
                        label: 'URL'
                    }],
                    onsubmit: function( e ) {
                        editor.insertContent( '<a class="c-button c-button--social c-button--primary" href="' + e.data.facebook + '"><i class=" icon-facebook-f"></i><span>facebook</span></a>');
                    }
                });
            }
        });

        editor.addButton( 'menu', {
            title: 'Menu',
            icon: 'icon is-dashicon dashicons-list-view',
            onPostRender: function () {
                jQuery( '.is-dashicon' ).css( 'font-family', 'dashicons' );
            },
            onclick: function() {
                editor.windowManager.open( {
                    title: 'Add menus shortcode',
                    body: [],
                    onsubmit: function( e ) {
                        editor.insertContent( '[menus]');
                    }
                });
            }
        });

        editor.addButton( 'button', {
            title: 'Button',
            icon: 'icon is-dashicon dashicons-button ',
            onPostRender: function () {
                jQuery( '.is-dashicon' ).css( 'font-family', 'dashicons' );
            },
            onclick: function() {
                editor.windowManager.open( {
                    title: 'Button',
                    body: [
                        {
                            type: 'textbox',
                            name: 'url',
                            label: 'URL'
                        },
                        {
                            type: 'textbox',
                            name: 'title',
                            label: 'Text'
                        },
                        {
                            type: 'listbox',
                            name: 'color',
                            label: 'Color',
                            values: [
                                {text: 'Primary', value: 'primary'},
                                {text: 'Secondary', value: 'secondary'},
                                {text: 'Tertiary', value: 'tertiary'}
                            ]
                        },
                        {
                            type: 'listbox',
                            name: 'type',
                            label: 'Type',
                            values: [
                                {text: 'Button', value: 'button'},
                                {text: 'Link', value: 'link'}
                            ]
                        }
                    ],
                    onsubmit: function( e ) {
                        editor.insertContent( '<a class="c-' + e.data.type + ' c-' + e.data.type + '--' + e.data.color + '" href="' + e.data.url + '">' + e.data.title + '</a>');
                    }
                });
            }
        });
    });

})();
