        <em>&copy; 2015</em>
        <script>
        $(document).ready(function(){

                
                $('.captcha-refresh').on('click', function(){
                        $.get('<?php echo base_url().'automoveis.php/pages/refresh'; ?>', function(data){
                                $('#image_captcha').html(data);
                        });
        
                });
                
                var totalRows = $('#tblData').find('tbody tr:has(td)').length;
                var recordPerPage = 10;
                var totalPages = Math.ceil(totalRows / recordPerPage);
                var $pages = $('<div id="pages"></div>');
                for (i = 0; i < totalPages; i++) {
                        $('<span class="pageNumber">&nbsp;' + (i + 1) + '</span>').appendTo($pages);
                }
                
                $pages.insertAfter('#tblData');

                $('.pageNumber').hover(function() {
                        $(this).addClass('focus');
                }, function() {
                        $(this).removeClass('focus');
                });
                
                $('#tblData').find('tbody tr:has(td)').hide();
                
                var tr = $('#tblData tbody tr:has(td)');
                
                for (var i = 0; i <= recordPerPage - 1; i++) {
                        $(tr[i]).show();
                }
                
                $('span').click(function(event) {
                        $('#tblData').find('tbody tr:has(td)').hide();
                        var nBegin = ($(this).text() - 1) * recordPerPage;
                        var nEnd = $(this).text() * recordPerPage - 1;
                        for (var i = nBegin; i <= nEnd; i++) {
                                $(tr[i]).show();
                        }
                });
        });

        </script>
        </body>
</html>