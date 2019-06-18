/*User signup validation processs*/
$(function(){
  $('#register').validate({
    rules: {
      Email: {
        required: true,
        email: true
      },
        Name: {
        required: true,
        minlength: 4
      },
      question: {
      required: true
      },
      feedback: {
      required: true
      },
      emailSubject: {
      required: true
      },
      response: {
      required: true
      },
      valPhone: {
      required: true,
      digits:true,
      minlength: 9
    },
      UserType: {
        required: true
      },
       valPassword: {
        required: true,
          minlength: 8
      },
      rePassword: {
        required: true,
          minlength: 8,
        equalTo: "#valPassword"
      }
    },
    //Sepcifing the validation messages
    messages: {
      Email: {
        required: "<span class='errorMessage'>Please enter an email address!</span>",
        email: "<span class='errorMessage'>Please enter a valid email address!</span>"
      },
      Name: {
        required: "<span class='errorMessage'>Please enter a username!</span>",
        minlength: "<span class='errorMessage'>Username must not be less than 4 characters!</span>",

      },
      question: {
        required: "<span class='errorMessage'>Please select your question</span>",
      },
      feedback: {
        required: "<span class='errorMessage'>Please enter your feedback here</span>",
      },
      emailSubject: {
        required: "<span class='errorMessage'>Please enter email subject</span>",
      },
      response: {
        required: "<span class='errorMessage'>Please enter response</span>",
        },
      valPhone: {
        required: "<span class='errorMessage'>Please enter a your phone number!</span>",
        digits: "<span class='errorMessage'>Please enter digits only!</span>",
        minlength: "<span class='errorMessage'>Phone number must not be less than 9 characters!</span>",

      },
      UserType: {
        required: "<span class='errorMessage'>Please select user category</span>"
      },
      valPassword: {
        required: "<span class='errorMessage'>Please enter a valid password!</span>",
        minlength: "<span class='errorMessage'>Your password must be at least 8 characters long!</span>"
      },
      rePassword: {
        required: "<span class='errorMessage'>Please enter a valid password!</span>",
        minlength: "<span class='errorMessage'>Your password must be at least 8 characters long!</span>",
        equalTo: "<span class='errorMessage'>password did not match!</span>"
      }
    }
  });
});

/*Login validation snippet*/
  $(function(){
    $('#login').validate({

      rules: {
          Username: {
          required: true
        },
        valPassword: {
          required: true
        }
      },
      //Sepcifing the validation messages
      messages: {
          Username: {
            required: "<span class='errorMessage'>Please enter a username!</span>",

          },
          valPassword: {
            required: "<span class='errorMessage'>Please enter a valid password</span>"
          }
      }
    });
  });
  /*Password reset validation snippet*/
  $(function(){
    $('#reset').validate({

      rules: {
          username: {
          required: true
        }
      },
      //Sepcifing the validation messages
      messages: {
          /*Username: {
            required: "<span class='errorMessage'>Please enter a username!</span>",

          }*/
      }
    });
  });

  /*User profile validation snippet*/
    $(function(){
      $('#profile_edit_form').validate({

        rules: {
            firstName: {
            required: true,
            nowhitespace:true,
            lettersonly:true
          },
          lastName: {
            required: true,
            nowhitespace:true,
            lettersonly:true
          },
          tel: {
              required: true,
              digits: true,
              minlength: 9
          },
          address: {
            required: true
          },
          profile: {
            required: true
          },
          city: {
            required: true
          },
          district: {
            required: true
          },
          region: {
            required: true
          }
        },
        //Sepcifing the validation messages
        messages: {
            // firstName: {
            //   required: "<span class='errorMessage'>Please enter a username!</span>",
            //
            // },
            // lastName: {
            //   required: "<span class='errorMessage'>Please enter a valid password</span>"
            // }
        }
      });
    });


    /*Property post validation snippet*/
      $(function(){
        $('#property_post').validate({

          rules: {
              description: {
              required: true
            },
            profile: {
              required: true
            },
            propertystatus: {
              required: true
            },
            propertytype: {
              required: true
            },
            region: {
              required: true
            },
            district: {
              required: true
            },
            cost: {
              digits: true
            },
            bed: {
              digits: true
            },
            parking: {
              digits: true
            },
            room: {
              digits: true
            },
            bath: {
              digits: true
            },
            city: {
              required: true
            }
          },
          //Sepcifing the validation messages
          messages: {
              /*Username: {
                required: "<span class='errorMessage'>Please enter a username!</span>",

              },
              valPassword: {
                required: "<span class='errorMessage'>Please enter a valid password</span>"
              }*/
          }
        });
      });

  /*Email confirmation validation validation snippet*/
    $(function(){
      $('#frmPasswordReset').validate({

        rules: {
            inputUsername: {
            required: true
          }
        },
        //Sepcifing the validation messages
        messages: {
            inputUsername: {
              required: "<span class='errorMessage'>Please enter a username!</span>"
            }
        }
      });
    });

    $(function (){
      $("[data-toggle='popover']"). popover();
    });


/*User signup validation processs for admin user*/
$(function(){
  $('#new_admin').validate({
    rules: {
       firstName: {
        required: true,
        nowhitespace:true,
        lettersonly:true
        },
       lastName: {
        required: true,
        nowhitespace:true,
        lettersonly:true
      },
      Email: {
        required: true,
        email: true
      },
      profile: {
        required: true
      },
      Name: {
        required: true,
        minlength: 4
      },
       valPassword: {
        required: true,
          minlength: 8
      },
      rePassword: {
        required: true,
          minlength: 8,
        equalTo: "#valPassword"
      }
    },
    //Sepcifing the validation messages
    messages: {
      /*rePassword: {
        required: "<span class='errorMessage'>Please enter a valid password!</span>",
        minlength: "<span class='errorMessage'>Your password must be at least 8 characters long!</span>",
        equalTo: "<span class='errorMessage'>password did not match!</span>"
      }*/
    }
  });
});