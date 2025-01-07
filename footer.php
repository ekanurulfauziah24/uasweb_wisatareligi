<style>
    
    html, body {
        height: 100%;
        margin: 0;
    }

    .container {
        min-height: 100%;
        display: flex;
        flex-direction: column;
    }

    .main-content {
        flex-grow: 1;
    }
</style>

<div class="container">
    
    <div class="main-content"></div>

   
    <footer class="text-black text-center py-4" style="background-color: #f8f9fa;">
        <div class="container">
            <p class="mb-2">&copy; <?= date("Y"); ?> Wisata Religi. Semua Hak Dilindungi.</p>
            
        
            <ul class="list-unstyled">
                <li>
                    <a href="https://www.facebook.com" target="_blank" class="text-black text-decoration-none">
                        <i class="bi bi-facebook"></i> Facebook : wisatareligiindonesia
                    </a>
                </li>
                <li>
                    <a href="https://www.twitter.com" target="_blank" class="text-black text-decoration-none">
                        <i class="bi bi-twitter"></i> Instagram : wisatareligiindonesia
                    </a> 
                </li>
            </ul>
        </div>
    </footer>
</div>
