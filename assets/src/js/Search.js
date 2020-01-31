import $ from 'jquery';

class Search {
  // 1. describe and create/initiate our object
  constructor() {
    this.addSearchHTML();
    this.resultsDiv = $("#search-overlay__results");
    this.openButton = $(".js-search-trigger");
    this.closeButton = $(".search-overlay__close");
    this.searchOverlay = $(".search-overlay");
    this.searchField = $("#search-term");
    this.events();
    this.isOverlayOpen = false;
    this.isSpinnerVisible = false;
    this.previousValue;
    this.typingTimer;
  }

  // 2. events
  events() {
    this.openButton.on("click", this.openOverlay.bind(this));
    this.closeButton.on("click", this.closeOverlay.bind(this));
    $(document).on("keydown", this.keyPressDispatcher.bind(this));
    this.searchField.on("keyup", this.typingLogic.bind(this));
  }
  

  // 3. methods (function, action...)
  typingLogic() {
    if (this.searchField.val() != this.previousValue) {
      clearTimeout(this.typingTimer);

      if (this.searchField.val()) {
        if (!this.isSpinnerVisible) {
          this.resultsDiv.html('<div class="spinner-loader"></div>');
          this.isSpinnerVisible = true;
        }
        this.typingTimer = setTimeout(this.getResults.bind(this), 750);
      } else {
        this.resultsDiv.html('');
        this.isSpinnerVisible = false;
      }

    }

    this.previousValue = this.searchField.val();
  }

  getResults() {
    $.getJSON(pcllData.root_url + '/wp-json/pcll/v1/search?term=' + this.searchField.val(), (results) => {
      this.resultsDiv.html(`
        <div class="row">
          <div class="col-sm">
            <h2 class="search-overlay__section-title">Products</h2>
            ${results.generalInfo.length ? '<ul class="link-list min-list">' : '<p>No products matches that search.</p>'}
              ${results.generalInfo.map(item => `<li><a href="${item.permalink}">${item.title}</a> }</li>`).join('')}
            ${results.generalInfo.length ? '</ul>' : ''}
          </div>
          <div class="col-sm">
            <h2 class="search-overlay__section-title">Podcasts</h2>
            ${results.podcasts.length ? '<ul class="link-list min-list">' : `<p>No podcasts match that search. <a href="${pcllData.root_url}/podcasts">View all podcasts</a></p>`}
              ${results.podcasts.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`).join('')}
            ${results.podcasts.length ? '</ul>' : ''}

            <h2 class="search-overlay__section-title">Instructors</h2>
            ${results.instructors.length ? '<ul class="instructor-cards">' : `<p>No instructors match that search.</p>`}
              ${results.instructors.map(item => `
                <li class="instructor-card__list-item">
                  <a class="instructor-card" href="${item.permalink}">
                    <img class="instructor-card__image" src="${item.image}">
                    <span class="instructor-card__name">${item.title}</span>
                  </a>
                </li>
              `).join('')}
            ${results.instructors.length ? '</ul>' : ''}

          </div>
          <div class="col-sm">
            <h2 class="search-overlay__section-title">Events</h2>
            ${results.events.length ? '' : `<p>No events match that search. <a href="${pcllData.root_url}/events">View all events</a></p>`}
              ${results.events.map(item => `
                <div class="event-summary">
                  <a class="event-summary__date t-center" href="${item.permalink}">
                    <span class="event-summary__month">${item.month}</span>
                    <span class="event-summary__day">${item.day}</span>  
                  </a>
                  <div class="event-summary__content">
                    <h5 class="event-summary__title headline headline--tiny"><a href="${item.permalink}">${item.title}</a></h5>
                    <p>${item.description} <a href="${item.permalink}" class="nu gray">Learn more</a></p>
                  </div>
                </div>
              `).join('')}

          </div>
        </div>
      `);
      this.isSpinnerVisible = false;
    });

  }

  keyPressDispatcher(e) {
    if (e.keyCode == 83 && !this.isOverlayOpen && !$("input, textarea").is(':focus')) {
      this.openOverlay();
    }

    if (e.keyCode == 27 && this.isOverlayOpen) {
      this.closeOverlay();
    }

  }

  openOverlay() {
    this.searchOverlay.addClass("search-overlay--active");
    $("body").addClass("body-no-scroll");
    this.searchField.val('');
    setTimeout(() => this.searchField.focus(), 301);
    console.log("our open method just ran!");
    this.isOverlayOpen = true;
  }

  closeOverlay() {
    this.searchOverlay.removeClass("search-overlay--active");
    $("body").removeClass("body-no-scroll");
    console.log("our close method just ran!");
    this.isOverlayOpen = false;
  }

  addSearchHTML() {
    $("body").append(`
      <div class="search-overlay">
        <div class="search-overlay__top">
          <div class="container">
            <i class="icon-search search-overlay__icon" aria-hidden="true"></i>
            <input type="text" class="search-term" placeholder="What are you looking for?" id="search-term">
            <i class="icon-cancel-circle search-overlay__close" aria-hidden="true"></i>
          </div>
        </div>
        
        <div class="container">
          <div id="search-overlay__results"></div>
        </div>

      </div>
    `);
  }

}

export default Search;