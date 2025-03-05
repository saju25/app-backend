<x-guest-layout>
    <!-- Sidebar -->
    <div class="sidebar collapse d-md-block" id="sidebar">
      @include('admin.sidebar')
    </div>
  
    <!-- Main content -->
    <div class="content">
      <div class="nav_container">
          <div class="nav_div">
              <nav class="navbar navbar-expand-md navbar-dark bg-dark">
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                  </button>
              </nav>
          </div>
      </div>
  
      <div class="container">
        <div class="conten_div">
            <div class="d-flex justify-content-center align-items-center">
                <div class="page section-header col-md-6 bg-white mt-5 mb-4 p-4">
                    <h1 class="mt-5">Envoyer une notification</h1>
                    <form id="notificationForm">
                        <label for="title">Titre</label>
                        <input class="p-2" type="text" id="title" name="title" placeholder="Entrez le titre" required />
  
                        <label for="body">Message</label>
                        <div>
                            <textarea class="w-100 p-2" id="body" name="message" placeholder="Entrez le texte du message" required></textarea>
                        </div>
                     
                        <button type="submit" class="btn btn-primary w-100 mt-1">Send Notification</button>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </div>
  </x-guest-layout>
  