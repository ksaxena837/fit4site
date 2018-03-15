<style>

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}



button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}
</style>
<div class="container">
        <form id="regForm" method="POST" action="<?php echo base_url();?>backend/profile/postF4sDocument" enctype="multipart/form-data">
          <div style="text-align:center;margin-top:40px;">
            <span class="panel panel-default step"></span>
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
          </div>
            <!-- One "tab" for each step in the form: -->
            <div class="tab">Media Type
              <div class="form-group">
                <select name="file_type" class="form-control">
                  <option value="photo">Photo</option>
                  <option value="document">Document</option>
                </select>
              </div>
            </div>
            <div class="tab">Visivilty Status
              <div class="form-group">
                  <select name="file_status" class="form-control">
                    <option value="public">Public</option>
                    <option value="adminonly">Private</option>
                    <option value="loggedin">Logged In</option>
                  </select>
              </div>
            </div>
            <div class="tab">Gallery Information:
                <div class="form-group">

                    <input type="text" name="gallery_title" class="form-control" placeholder="Gallery Title (Required)">
                </div>
                <div class="form-group">
                    <textarea name="gallery_description" class="form-control" placeholder="Gallery Description"></textarea>
                </div>
            </div>
            <div class="tab"> Media :

                  <input type="file" name="mediafile[]" multiple>
            </div>
            <div style="overflow:auto;">
              <div style="float:right;">
                <button type="button" id="prevBtn" class="btn btn-default" onclick="nextPrev(-1)">Previous</button>
                <button type="button" id="nextBtn" class="btn btn-primary" onclick="nextPrev(1)">Next</button>
              </div>
            </div>
            <!-- Circles which indicates the steps of the form: -->

          </form>
    </div>
<script>
      var currentTab = 0;
      showTab(currentTab);

      function showTab(n) {
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        if (n == 0) {
          document.getElementById("prevBtn").style.display = "none";
        } else {
          document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
          document.getElementById("nextBtn").innerHTML = "Submit";
        } else {
          document.getElementById("nextBtn").innerHTML = "Next";
        }
        fixStepIndicator(n)
      }

      function nextPrev(n) {
        var x = document.getElementsByClassName("tab");
        if (n == 1 && !validateForm()) return false;
        x[currentTab].style.display = "none";
        currentTab = currentTab + n;
        if (currentTab >= x.length) {
          document.getElementById("regForm").submit();
          return false;
        }
        showTab(currentTab);
      }

      function validateForm() {
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");
        for (i = 0; i < y.length; i++) {

          if (y[i].value == "") {

            y[i].className += " invalid";

            valid = false;
          }
        }

        if (valid) {
          document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid;
      }

      function fixStepIndicator(n) {

        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
          x[i].className = x[i].className.replace(" active", "");
        }
        x[n].className += " active";
      }
</script>
