<fieldset>
   <div class="input-group">
      <label for="Your name" class="input-group__label">
         <span class="input-group__label__span">
            Full name
         </span>
         [text yourname]
      </label>
   </div>
   <div class="input-group">
      <input type="button" name="next" class="next action-button" value="Next" />
   </div>
</fieldset>

<fieldset>
   <div class="input-group">
      <label for="Dietry requirements" class="input-group__label">
         <span class="input-group__label__span">
            Dietry requirements
            <br>
            Are you allergic to anything? What about vegetarian/vegan? Let us know!
         </span> 
         [textarea dietryrequirements]
      </label>
   </div>
   <div class="input-group">
      <input type="button" name="previous" class="previous action-button" value="Previous" />
      <input type="button" name="next" class="next action-button" value="Next" />
   </div>
</fieldset>

<fieldset>
   <div class="input-group">
      <label for="Date of arrival" class="input-group__label">
         <span class="input-group__label__span">
            Date of arrival
         </span> 
         [date dateofarrival min:2018-07-01]
      </label>
   </div>
   <div class="input-group">
      <input type="button" name="previous" class="previous action-button" value="Previous" />
      <input type="button" name="next" class="next action-button" value="Next" />
   </div>
</fieldset>

<fieldset>
   <div class="input-group">
      <label for="Meal choice" class="input-group__label">
         <span class="input-group__label__span">
            Meal choice
         </span>
         [radio mealchoice label_first default:1 "Chicken" "Lamb" "Vegetarian"]
      </label>
   </div>
   <div class="input-group">
      <input type="button" name="previous" class="previous action-button" value="Previous" />
      <input type="button" name="next" class="next action-button" value="Next" />
   </div>
</fieldset>

<fieldset>
   <div class="input-group">
      <label for="Song requests" class="input-group__label">
         <span class="input-group__label__span">
            Lastly, got any song requests?
         </span> 
         [textarea songchoice]
      </label>
   </div>
   <div class="input-group">
      <input type="button" name="previous" class="previous action-button" value="Previous" />
      [submit class:submit-action-button class:action-button]
   </div>
</fieldset>

<fieldset>
   [response]
</fieldset>