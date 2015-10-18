function process(response) {
        var flag = 0;
        var chess_clicked = 'chess-clicked';
        if (200 == response.status) {
            var json = response.responseText.evalJSON(true);
            flag = 1;
        }
        if (flag == 1) {
            var n = Object.keys(json).length;
            for (i = 0; i < n; i++) {
                var img = new Image();
                $('cell-' + json[i].position).appendChild(img);
                img.src = json[i].image;
                img.className = 'chess';
                img.alt = '';
                img.id = json[i].type+'-'+json[i].position;
                img.onclick = function(){
                    var images = $$(".chess");
                        images.each(function(box){
                            box.classList.remove(chess_clicked);
                        });
                        var cells = $$(".cell");
                        cells.each(function(box){
                            box.classList.remove('cell-selected');
                        })
                    $(this.id).classList.add(chess_clicked);
                    //new DragObject($(this.id));
                    analyzeStep(this.id, false, 0);
                }
            }

        }
        $('start-game').hide();
        $('onstart').show();
    }

function analyzeStep(position, flag, counter){
        var alpha =  ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];
        var literal = position.substr(-1);
        var number = parseInt(position.charAt(2));
        var alpha_index = alpha.indexOf(literal);
        var type = position.charAt(0);
        var hor_shift = 1;
        var vert_shift = 1;
        var new_class = 'cell-selected';
        if(counter < 2 ){
        if(number != 1  || number != 8){
            if(type == 'w'){
                if(alpha_index != 7 && flag !='l'){
                    var right_position = number+vert_shift+alpha[alpha_index+hor_shift];
                    if($('w-'+right_position) != null){
                        
                    }else if($('b-'+right_position) != null){
                        analyzeStep('w-'+right_position, 'r', counter + 1);
                    }else{
                        $('cell-'+right_position).classList.add(new_class);
                    }
                }
                if(alpha_index != 0 && flag != 'r'){
                    var left_position = number+vert_shift+alpha[alpha_index-hor_shift];
                    if($('w-'+left_position) != null){
                        
                    }else if($('b-'+left_position) != null){
                       analyzeStep('w-'+left_position, 'l', counter + 1);
                    }else{
                       $('cell-'+left_position).classList.add(new_class);
                    }
                    
                }
            }else{
                if(alpha_index != 7 && flag !='l'){
                    var right_position = number-vert_shift+alpha[alpha_index+hor_shift];
                    if($('b-'+right_position) != null){
                        
                    }else if($('w-'+right_position) != null){
                       analyzeStep('b-'+right_position, 'r', counter + 1);
                    }else{
                       $('cell-'+right_position).classList.add(new_class);
                    }
                    
                }
                if(alpha_index != 0 && flag != 'r'){
                    var left_position = number-vert_shift+alpha[alpha_index-hor_shift];
                    if($('b-'+left_position) != null){
                        
                    }else if($('w-'+left_position) != null){
                       analyzeStep('b-'+left_position, 'l', counter + 1);
                    }else{
                      $('cell-'+left_position).classList.add(new_class);
                    }
                    
                }
            }
        }   
        }
        
    }
    
    function deepAnalyze(){
        
    }