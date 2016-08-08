<div class="columns-area">
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="panel-tabs">
				<md-button class="md-btn" ng-href="orgpage-settings-main.html" aria-label="tabSettingsMain" md-ink-ripple="#64b5f6">
					Организация
					<div class="active-link"></div>
				</md-button>
				<md-button class="md-btn" ng-href="orgpage-settings-team.html" aria-label="tabSettingsTeam" md-ink-ripple="#64b5f6">
					Команда
					<div class="active-link"></div>
				</md-button>
				<md-button class="md-btn active" ng-href="orgpage-settings-logs.html" aria-label="tabSettingsLogs" md-ink-ripple="#64b5f6">
					Активности
					<div class="active-link"></div>
				</md-button>
				<md-button class="md-btn" ng-href="orgpage-settings-balance.html" aria-label="tabSettingsBalance" md-ink-ripple="#64b5f6">
					Оплата услуг
					<div class="active-link"></div>
				</md-button>
			</div>
		</div>
		<div class="panel-body" ng-controller="logCtrl as logs">
			<h4>Лог активностей</h4>
			<ul style="margin: 10px 0;">
				<li class="logs-description no-li inline" ng-repeat="item in logs.logDesc">
					<span class="inline" style="background-color: {{item.color}}"></span>
					<p class="inline">{{item.name}}</p>
				</li>
			</ul>
			<ul>
				<li class="log-activites no-li" ng-repeat="log in logs.logInfo | orderBy: '-date' | limitTo: 3" style="border-left: 3px solid {{log.type | getTypeofLog}};">
					<small>{{log.date | date:"d MMMM y"}}</small>
					<p>
						{{log.iduser | userName}} {{log.type | getLogAction}}
						<md-button ng-href="#/{{log.idevent | eventLink}}" aria-label="logs" class="md-btn md-btn-xs" md-ink-ripple="#64b5f6">
							{{log.idevent | eventName}}
						</md-button>
					</p>
				</li>
			</ul>
		</div>
	</div>
</div>