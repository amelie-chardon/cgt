$(document).ready(function()
{
    $preview=[];



    $('#prv').click(function()
    {
        $preview=[];
        $titre = document.getElementById('titre').value;
        $stitre = document.getElementById('stitre').value;
        $image = document.getElementById('img').value;
        $section = document.getElementById('section').value;
        $article = document.getElementById('article').value;

        $preview.push($titre);
        $preview.push($stitre);
        $preview.push($image);
        $preview.push($section);
        $preview.push($article);
        console.log($preview);


        $.ajax(
            {
            url: "preview.php", 
            type : 'POST',
            data: {$preview},
            
            success: function(result)
                {
                    $("#previ").html(result);
                  
                }
            }
            );
       
        
    });
});

