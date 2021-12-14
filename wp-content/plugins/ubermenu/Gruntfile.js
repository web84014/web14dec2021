module.exports = function(grunt) {

  require('google-closure-compiler').grunt(grunt);
  require('load-grunt-tasks')(grunt);

  var less_skins = grunt.file.expand({filter: "isFile", cwd: "pro/assets/css/skins"}, ["*.less"]);
  less_skins.map( function( s ) {
    var name = s.substring( 0 , s.length - 5 );
    grunt.file.write( 'pro/assets/css/skins/prefix/'+name+'.prefix.less' ,
      'PREFIX{ @import (less) "../'+name+'.css"; }'
    );
  });

  var config = {
    pkg: grunt.file.readJSON('package.json'),

    cssmin: {
      options: {
        banner:
          "/*\n"+
           " * UberMenu 3 \n" +
           " * http://wpmegamenu.com \n" +
           " * Copyright 2011-2019 Chris Mavricos, SevenSpark \n" +
           " */"
      },
      minify: {
        files: {
          'assets/css/ubermenu.min.css' : ['assets/css/ubermenu.css'],
          'pro/assets/css/ubermenu.min.css' : ['pro/assets/css/ubermenu.css']
        }
      }
    },

    // 'closure-compiler': {
    //   frontend: {
    //     closurePath: '/usr/local/opt/closure-compiler/libexec', // '/usr/local/lib/closure-compiler',
    //     js: 'assets/js/*.js',
    //     jsOutputFile: 'assets/js/ubermenu.min.js',
    //     maxBuffer: 500,
    //     options: {
    //       compilation_level: 'SIMPLE_OPTIMIZATIONS',
    //       language_in: 'ECMASCRIPT5_STRICT'
    //     }
    //   }
    // },

    'closure-compiler': {
      ubermenujs: {
        files: {
          'assets/js/ubermenu.min.js': ['assets/js/ubermenu.js']
        },
        options: {
          compilation_level: 'SIMPLE_OPTIMIZATIONS',
          output_wrapper: '',
          debug: false,
          language_in: 'ECMASCRIPT5_STRICT',
          language_out: 'ECMASCRIPT5_STRICT'
        }
      }
    },

    less: {
      development: {
        options: {
          compress: false,
        },
        files: [
          {
            "assets/css/ubermenu.css": "assets/css/ubermenu.less"
          },
          {
            "pro/assets/css/ubermenu.css": "pro/assets/css/ubermenu.less"
          },

          {
            "custom/custom-sample-skin.css": "pro/assets/css/skins/custom-skin.less"
          },
          {
            expand: true,
            cwd: 'pro/assets/css/skins/',
            src: ['*.less'],
            dest: 'pro/assets/css/skins/',
            ext: '.css'
            // target.css file: source.less file
            //"pro/assets/css/skins/blackwhite2.css": "pro/assets/css/skins/blackwhite2.less"
          },
          {
            expand: true,
            cwd: 'pro/assets/css/skins/',
            src: ['blackwhite2.less','blackwhite.less','vanilla.less','vanilla_bar.less', 'minimal.less'],
            dest: 'assets/css/skins',
            ext: '.css'
            // target.css file: source.less file
            //"pro/assets/css/skins/blackwhite2.css": "pro/assets/css/skins/blackwhite2.less"
          },
        ]
      },
      prefix: {
        options: {
          compress: false,  //change to true later?
        },
        files: [
          //Main File
          {
            "pro/assets/css/ubermenu.prefix.css" : "pro/assets/css/prefix.less"
          },
          //Skins
          {
            expand: true,
            cwd: 'pro/assets/css/skins/prefix',
            src: ['*.less'],
            dest: 'pro/assets/css/skins/prefix',
            ext: '.prefix.css'
          },
          //Responsive LESS files
          {
            expand: true,
            cwd: 'assets/css/less/prefix',
            src: ['responsive_*prefix.src.less'], //only the responsive files
            dest: 'assets/css/less/prefix',
            ext: '.less'
            // target.css file: source.less file
            //"pro/assets/css/skins/blackwhite2.css": "pro/assets/css/skins/blackwhite2.less"
          },
        ]
      }
    },

    makepot: {
      target: {
        options: {
          mainFile: 'ubermenu.php',
          domainPath: '/languages',
          // include: [
          //   'path/to/some/file.php'
          // ],
          type: 'wp-plugin', // or `wp-theme`
          potHeaders: {
            poedit: true
          }
        }
      }
    },

    devUpdate: {
        main: {
            options: {
                //task options go here
            }
        }
    }

  };

  // config.less.prefix = {
  //   options: {
  //     compress: false,  //change to true later?
  //   },
  //   files: [
  //     {
  //       "custom/ubermenu-prefix.css" : "pro/assets/css/prefix.less"
  //     }
  //   ]
  // };
  //
  // config.less.prefix_aq = {
  //   options: {
  //     compress: false,  //change to true later?
  //     modifyVars: {
  //       file: 'pro/assets/css/skins/aqua.css'
  //     }
  //   },
  //   files: [
  //     {
  //       "pro/assets/css/skins/prefix/aqua.css" : "pro/assets/css/prefix.less"
  //     }
  //   ]
  // };

  // var less_skins = grunt.file.expand({filter: "isFile", cwd: "pro/assets/css/skins"}, ["*.less"]);
  // less_skins.map( function( s ) {
  //   var name = s.substring( 0 , s.length - 5 );
  //   config.less['prefix_'+name] = {
  //     options: {
  //       compress: false,  //change to true later?
  //       modifyVars: {
  //         file: s
  //       }
  //     },
  //     files: [
  //       {
  //         "pro/assets/css/skins/prefix/<%= name =%>.css" : "pro/assets/css/prefix.less"
  //       }
  //     ]
  //   };
  // });
  //console.log( config.less );

  grunt.initConfig(config);

  // Load the plugin that provides the "uglify" task.
  //grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  //grunt.loadNpmTasks('grunt-closure-compiler');
  grunt.loadNpmTasks('grunt-wp-i18n');
  grunt.loadNpmTasks('grunt-dev-update');


  // Default task(s).
  //grunt.registerTask('default', ['uglify']);
  grunt.registerTask('default', ['less','cssmin','closure-compiler','makepot']);

  grunt.registerTask('css', ['less','cssmin']);

  grunt.registerTask('go', ['less','cssmin','closure-compiler']);

  grunt.registerTask('compile', ['closure-compiler']);

  grunt.registerTask('pot', ['makepot']);

  grunt.registerTask('devupdate', ['devUpdate']);

};
