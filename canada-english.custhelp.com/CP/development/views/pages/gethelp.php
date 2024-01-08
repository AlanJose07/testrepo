<rn:meta template="standard_responsive_bb.php" clickstream="home"/>


  <rn:widget path="custom/ResponsiveDesign/CategoryTile" interface=2 page=2/>
  
  <div class="divider mob_divider"></div>
  <section>
    <div class="container">
      <div class="row">
        <div class="ftr-search">
          <h1>Search something else</h1>
          <div class="search-wrap">
			 <form class="form-horizontal" onSubmit="return false;">
            <rn:container report_id="176">
            <div class="form-group form-group-md">
              <rn:widget path="search/KeywordText" label_text="" label_placeholder="Enter a question or FAQ#" initial_focus="false"/>
              <span class="input-group-btn">
              <rn:widget path="search/SearchButton" report_page_url="/app/answers/list"/>
              </span> </div>
             </rn:container>
        </form>
          </div>
        </div>
      </div>
    </div>
  </section>
